import { validateUsername, validatePassword, validateEmail } from '../validators/registerValidator.js';

export function initRegisterController() {

    const form = document.getElementById('registerForm');
    const errorBox = document.getElementById('errorMessage');
    const btnCancel = document.getElementById('btnCancelRegister');

    if (form) {
        const x = Math.floor(Math.random() - 0.5) * 400;
        const y = Math.floor(Math.random() - 0.5) * 400;

        form.style.backgroundPosition = `${x} ${y}`;
    }

    const params = new URLSearchParams(window.location.search);
    const returnTo = params.get('return');
    const taleId = params.get('tale');

    const routes = {
        create: 'index.php?v=create',
        fragment: `index.php?v=fragment&tale=${taleId}`
    };

    if (!form) return;

    const validators = {
        username: validateUsername,
        password: validatePassword,
        email: validateEmail
    };

    form.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => {
            const fieldName = input.name;
            const validator = validators[fieldName];

            if (!validator) return

            const errorEl = document.querySelector(`[data-error-for="${fieldName}"]`);
            if (!errorEl) return;

            if (errorEl.textContent === '') return;

            const result = validator(input.value);

            if (result.valid) {
                errorEl.textContent = '';
                errorEl.style.display = 'none';
            } else {
                errorEl.textContent = result.error;
            }
        });
    });

    form.addEventListener('submit', async (e) => {

        e.preventDefault();

        clearFieldErrors();

        if (errorBox) {
            errorBox.style.display = 'none';
            errorBox.textContent = '';
        }

        const formData = new FormData(form);

        for (const [fieldName, validator] of Object.entries(validators)) {

            const value = formData.get(fieldName);
            const result = validator(value);

            if (!result.valid) {
                showFieldError(fieldName, result.error);
                return;
            }
        }

        try {
            const response = await fetch('api/register.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (!data.success) {
                console.error('Register error:', data.error);
                if (errorBox) {
                    errorBox.textContent = data.error || 'Registration error';
                    errorBox.style.display = 'block';
                }
                return;
            }

            window.location.href = routes[returnTo] ?? 'index.php?v=home';

        } catch (err) {
            console.error('Network error:', err);
            if (errorBox) {
                errorBox.style.display = 'block';
                errorBox.textContent = 'Network error';
            }
        }
    });

    function showFieldError(fieldName, message) {
        const errorEl = document.querySelector(`[data-error-for="${fieldName}"]`);

        if (!errorEl) return;

        errorEl.textContent = message;
        errorEl.style.display = 'block';
    }

    function clearFieldErrors() {
        document.querySelectorAll('.error-field').forEach(el => {
            el.textContent = '';
            el.style.display = 'none';
        });
    }

    btnCancel.addEventListener('click', (e) => {

        form.reset();

        if (errorBox) {
            errorBox.style.display = 'none';
            errorBox.textContent = '';
        }

        window.location.href = routes[returnTo] ?? 'index.php?v=home';
    });
}