export async function initTalesController() {

    const openContainer = document.getElementById('openTales');
    const closeContainer = document.getElementById('closeTales');

    if (!openContainer || !closeContainer) return;

    const view = openContainer.dataset.view;

    try {

        const res = await fetch('api/getTales.php');
        const json = await res.json();

        if (!json.success) {
            console.error('getTales error', json.error);
            return;
        }

        const { open, close } = json.data;

        const openTales = view === 'profile' ? open.profile : open.home;
        const closeTales = view === 'profile' ? close.profile : close.home;

        renderList(openTales, openContainer);
        renderList(closeTales, closeContainer);
    } catch (e) {
        console.error('getTales error', e);
    }
}

function renderList(tales, container) {
    container.innerHTML = '';

    if (!tales || !container) {
        const msg = document.createElement('li');
        msg.textContent = 'There is no tale yet...';
        container.appendChild(msg);
        return;
    }

    const isOpen = container.id === 'openTales';

    tales.forEach(tale => {

        const link = isOpen
            ? `index.php?v=fragment&tale=${tale.id}`
            : `index.php?v=consult&tale=${tale.id}`;

        const rawDate = isOpen
            ? tale.createdAt
            : tale.finishedAt;

        const timeTitle = isOpen
            ? 'Created'
            : 'finished';

        const labelDate = formatData(rawDate);

        const labelSteps = isOpen
            ? `${tale.current_step}/${tale.steps}`
            : `${tale.steps}`;

        const item = document.createElement('li');

        item.classList.add(getRandomSlide());

        item.innerHTML = `
        <a hrer="${link}">${tale.title}</a>
        <br>
        <span> ${tale.theme} </span>
        <span> - Steps: ${labelSteps} </span>
        <span> - ${timeTitle}: ${labelDate} </span>
        `;

        container.appendChild(item);

        requestAnimationFrame(() => {
            void item.offsetWidth;
            item.classList.add('is-active');
        });
    });
}

function formatData(dateString) {
    const date = new Date(dateString);

    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}

function getRandomSlide() {
    const r = Math.floor(Math.random() * 4);

    switch (r) {
        case 0: return 'slide-up';
        case 1: return 'slide-right';
        case 2: return 'slide-left';
        case 3: return 'slice-down';
    }
}
