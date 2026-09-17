const params = new URLSearchParams(window.location.search);
const view = params.get('v') ?? 'home';

import { initFragmentValidator } from './validators/fragmentValidator.js';
import { closeActionBox, showActionBox } from './ui/actionBox.js';

initFragmentValidator();

switch (view) {
    case 'home': {
        const { initTalesController } = await import('./controllers/talesController.js');
        const { initHomeController } = await import('./controllers/homeController.js');

        initTalesController();
        initHomeController();
        break;
    }

    case 'profile': {
        const { initTalesController } = await import('./controllers/talesController.js');
        const { initHomeController } = await import('./controllers/homeController.js');

        initTalesController();
        initHomeController();
        break;
    }

    case 'create': {
        const { initTaleSubmitController } = await import('./controllers/taleSubmitController.js');
        restoreTaleFormStorage();
        persistTaleFormToStorage();
        initTaleSubmitController();
        break;
    }

    case 'fragment': {
        const { initLastFragmentController } = await import('./controllers/lastFragmentController.js');
        const { initTaleSubmitController } = await import('./controllers/taleSubmitController.js');
        restoreTaleFormStorage();
        persistTaleFormToStorage();
        initLastFragmentController();
        initTaleSubmitController();
        break;
    }

    case 'consult': {
        const { initConsultTaleController } = await import('./controllers/consultTaleController.js');
        initConsultTaleController();
        break;
    }

    case 'login': {
        const { initLoginController } = await import('./controllers/loginController.js');
        initLoginController();
        break;
    }

    case 'register': {
        const { initRegisterController } = await import('./controllers/registerController.js');
        initRegisterController();
        break;
    }

}

function restoreTaleFormStorage() {
    const form = document.getElementById('taleForm');
    if (!form) return;

    const fields = ['title', 'theme', 'steps', 'keyword', 'fragment'];

    fields.forEach((id) => {
        const element = document.getElementById(id);
        const storedValue = sessionStorage.getItem(id);

        if (element && storedValue !== null) {
            element.value = storedValue;

            if (id === 'fragment') { element.dispatchEvent(new Event('input')); }
        }
    });
}

function persistTaleFormToStorage() {
    const form = document.getElementById('taleForm');
    if (!form) return;

    const fields = ['title', 'theme', 'steps', 'keyword', 'fragment'];

    fields.forEach((id) => {
        const element = document.getElementById(id);
        if (!element) return;

        element.addEventListener('input', () => { sessionStorage.setItem(id, element.value); })
    });
}

const logoutBtn = document.getElementById('btnLogout');

if (logoutBtn) {
    logoutBtn.addEventListener('click', () => {
        showActionBox({
            title: 'Close session',
            message: 'You sure you wanna leave?',
            actions: [
                {
                    label: 'Yes',
                    action: async () => {
                        try {
                            const response = await fetch('api/logout.php', {
                                method: 'POST'
                            });

                            const data = await response.json();

                            if (!response.ok || !data.success) {
                                throw new Error(data.error || 'Logout failed');
                            }

                            const fields = ['title', 'theme', 'steps', 'keyword', 'fragment'];
                            fields.forEach(key => sessionStorage.removeItem(key));

                            window.location.href = 'index.php';

                        } catch (e) {
                            console.error('Logout error', e);
                        }


                    }
                }, {
                    label: 'No',
                    action: () => {
                        closeActionBox();
                    }
                }
            ]
        });
    });
}

