export function  showActionBox(config) {

    const { title, message, actions, type='neutral', dismisible = false } = config;

    if ( !title || !message || !Array.isArray(actions) || actions.length === 0) {
            console.log('actionBox: wrong config!');
        return;
    }

    // OVERLAY
    const overlay = document.createElement('div');
    overlay.id = 'actionBoxOverlay';
    overlay.className = 'action-box-overlay';

    // BOX
    const box = document.createElement('div');
    box.className = `action-box action-box--${type}`;
    box.classList.add('slide-up');

    // TITLE
    const h3 = document.createElement('h3');
    h3.textContent = title;

    // MESSAGE
    const p = document.createElement('p');
    p.textContent = message;

    // ACTIONS
    const actionsContainer = document.createElement('div');
    actionsContainer.className = 'action-box-actions';
        
    actions.forEach(({ label, action }) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = label;

        btn.addEventListener('click', ()=> {
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

    requestAnimationFrame(() => {
        void box.offsetWidht;
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
    }, {once: true});
}    
