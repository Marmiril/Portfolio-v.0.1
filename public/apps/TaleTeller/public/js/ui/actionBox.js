export function showActionBox(config) {

    if (document.getElementById('actionBoxOverlay')) return;

    const { title, message, actions, type = 'neutral', dismissible = true } = config;

    if (!title || !message || !Array.isArray(actions) || actions.length === 0) {
        console.error('actionBox: invalid configuration');
    }

    const overlay = document.createElement('div');
    overlay.id = 'actionBoxOverlay';
    overlay.className = 'action-box-overlay';

    const box = document.createElement('div');
    box.className = `action-box action-box--${type}`;
    box.classList.add('slide-up');

    if (dismissible) {
        const closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.className = 'action-box-close';
        closeBtn.innerHTML = '&times';

        closeBtn.addEventListener('click', closeActionBox);

        box.appendChild(closeBtn);
    }

    const h3 = document.createElement('h3');
    h3.textContent = title;

    const p = document.createElement('p');
    p.textContent = message;

    const actionsContainer = document.createElement('div');
    actionsContainer.className = 'action-box-actions';

    actions.forEach(({ label, action }) => {
        const btn = document.createElement('button')
        btn.type = 'button';
        btn.textContent = label;

        btn.addEventListener('click', () => {
            closeActionBox();
            if (typeof action === 'function') {
                action();
            }
        });
        actionsContainer.appendChild(btn);
    });

    box.appendChild(h3);
    box.appendChild(p);
    box.appendChild(actionsContainer);
    overlay.appendChild(box);
    document.body.appendChild(overlay);

    if (dismissible) {
        const escHandler = (e) => {
            if (e.key === 'Escape') {
                closeActionBox();
                document.removeEventListener('keydown', escHandler);
            }
        };

        document.addEventListener('keydown', escHandler);
    }

    requestAnimationFrame(() => {
        void box.offsetWidth;
        box.classList.add('is-active');
    });
}

export function closeActionBox() {
    const overlay = document.getElementById('actionBoxOverlay');
    if (!overlay) return;

    const box = document.querySelector('.action-box');
    if (!box) {
        overlay.remove();
        return;
    }

    box.classList.remove('is-active');

    box.addEventListener('transitionend', () => {
        overlay.remove();
        box.remove();
    }, { once: true });
}