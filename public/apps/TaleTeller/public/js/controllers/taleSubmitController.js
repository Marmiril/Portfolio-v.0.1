import { validateTaleForm } from '../validators/taleFormValidator.js';
import { showActionBox } from '../ui/actionBox.js';

export function initTaleSubmitController() {

    const form = document.getElementById('taleForm');
    const publishBtn = document.getElementById('btnPublish');

    if (!form || !publishBtn) return;

    publishBtn.addEventListener('click', async () => {
        const errorBox = document.getElementById('errorMessage');

        if (errorBox) {
            errorBox.style.display = 'none';
            errorBox.textContent = '';
        }

        const result = validateTaleForm();

        if (!result.valid) {
            if (errorBox) {
                errorBox.textContent = result.error;
                errorBox.style.display = 'block';
            }
            return;
        }

        const taleId = form.dataset.taleId;
        const isCreateMode = !taleId;

        const endpoint = isCreateMode
            ? 'api/beginTale.php'
            : 'api/addFragment.php';

        const formData = new FormData(form);

        if (!isCreateMode) { formData.append('tale_id', taleId); }

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                body: formData
            });

            if (response.status === 401) {

                const returnTo = isCreateMode ? 'create' : 'fragment';
                const taleParam = isCreateMode ? '' : `&tale=${taleId}`;

                showActionBox({
                    title: 'Authentication required',
                    message: 'Register is necessary before publishing',
                    type: 'decision',
                    actions: [
                        {
                            label: 'Login',
                            action: () => {
                                window.location.href = `index.php?v=login&return=${returnTo}${taleParam}`;
                            }
                        },
                        {
                            label: 'Register',
                            action: () => {
                                window.location.href = `index.php?v=register&return=${returnTo}${taleParam}`;
                            }
                        }
                    ]
                });
                return;
            }

            const data = await response.json();

            if (!data.success) {
                console.error('Server error:', data.error);

                const errorBox = document.getElementById('errorMessage');
                if (errorBox) {
                    errorBox.textContent = data.error;
                    errorBox.style.display = 'block';
                }
                return;
            }

            const fieldsToClear = ['title', 'theme', 'steps', 'keyword', 'fragment'];
            fieldsToClear.forEach(key => sessionStorage.removeItem(key));

            if (isCreateMode && data.tale_id) {
                form.dataset.taleId = data.tale_id;
            }

            showActionBox({
                title: 'Fragment added successfully!!',
                message: isCreateMode
                    ? 'The begining has just been added'
                    : 'Your fragment has been added successfully',
                actions: [
                    {
                        label: 'Home',
                        action: () => {
                            window.location.href = 'index.php?v=home'
                        }
                    },
                    {
                        label: 'Profile',
                        action: () => {
                            window.location.href = 'index.php?v=profile'
                        }
                    }
                ]
            });
        } catch (err) {
            console.error('Network error: ', err);
        }
    });

    const cancelBtn = document.getElementById('cancelPublish');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            showActionBox({
                title: 'Cancel',
                message: 'Everything will be lost... Continue?',
                actions: [
                    {
                        label: 'Yes',
                        action: () => {
                            const fields = ['title', 'theme', 'steps', 'keyword', 'fragment'];
                            fields.forEach(key => sessionStorage.removeItem(key));
                            window.location.href = 'index.php';
                        }
                    },
                    {
                        label: 'No',
                        action: () => { }
                    }
                ]
            });
        });
    }
}
