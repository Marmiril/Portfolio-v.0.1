export function initFragmentValidator() {
    const textarea = document.getElementById('fragment');
    const counter = document.getElementById('wordCounter');
    const consol = document.getElementById('console');

    if (!textarea || !counter || !consol) { return; }

    textarea.addEventListener('input', () => {
        const text = textarea.value.trim();

        const words = text === ''
            ? 0
            : text.split(/\s+/).length;

        counter.textContent = `Words (150-600): ${words}`;

        if (words < 150 || words > 600) {
            counter.classList.add('invalid');
            counter.classList.remove('valid');
            textarea.dataset.valid = 'false';
            consol.classList.remove('is-active');
        } else {
            counter.classList.remove('invalid');
            counter.classList.add('valid');
            textarea.dataset.valid = 'true';
            consol.classList.add('is-active');
        }
    });

}