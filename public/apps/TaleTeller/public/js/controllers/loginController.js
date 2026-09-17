export function initLoginController() {

    const form = document.getElementById('loginForm');
    const errorBox = document.getElementById('errorMessage');
    const btnCancel = document.getElementById('btnCancelLogin');

    const params = new URLSearchParams(window.location.search);
    const returnTo = params.get('return');
    const taleId = params.get('tale');

    if (form) {
        const x = Math.floor(Math.random() * 1000);
        const y = Math.floor(Math.random() * 1000);

        form.style.backgroundPosition = `${x}px ${y}px`;
    }

    const routes = {
        create: 'index.php?v=create',
        fragment: `index.php?v=fragment&tale=${taleId}`
    }

    if (!form) return;

    form.addEventListener('submit', async (e) => {

        e.preventDefault();

        if (errorBox) {
            errorBox.style.display = 'none';
            errorBox.textContent = '';
        }

        const formData = new FormData(form);

        try {
            const response = await fetch('api/login.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (!data.success) {
                console.error('Login error', data.error);

                if (errorBox) {
                    errorBox.textContent = data.error || 'Login error';
                    errorBox.style.display = 'block';
                }
                return;
            }

            console.log('Logged user:', data.user);

            window.location.href = routes[returnTo] ?? 'index.php?v=home';
        } catch (err) {
            console.error('Network error:', err);
            if (errorBox) {
                errorBox.textContent = 'Network error';
                errorBox.style.display = 'block';
            }
        }
    });

    btnCancel?.addEventListener('click', (e) => {
        form.reset();

        if (errorBox) {
            errorBox.style.display = 'none';
            errorBox.textContent = '';
        }

        window.location.href = routes[returnTo] ?? 'index.php?v=home';
    });
}
