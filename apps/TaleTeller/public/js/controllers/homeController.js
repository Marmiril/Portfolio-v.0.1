export function initHomeController() {
    const toggles = document.querySelectorAll('[data-toggle]');

    toggles.forEach(toggle => {

        const targetId = toggle.dataset.toggle;
        const target = document.getElementById(targetId);

        if (!target) return;

        toggle.addEventListener('click', () => {
            target.classList.add('is-active');
            toggle.style.display = 'none';
        });
    });
}