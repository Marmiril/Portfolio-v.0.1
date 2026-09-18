export async function initConsultTaleController() {

    const metaContainer = document.getElementById('taleMeta');
    const taleContainer = document.getElementById('fullTale');

    if (!metaContainer || !taleContainer) return;

    const params = new URLSearchParams(window.location.search);
    const taleId = params.get('tale');

    if (!taleId) { taleContainer.textContent = 'Tale not found'; return; }

    taleContainer.innerHTML = '<p>Loading tale...</p>';
    metaContainer.innerHTML = '';
    try {
        const res = await fetch(`api/getTale.php?tale_id=${taleId}`);
        const data = await res.json();

        if (!data || !data.tale || !Array.isArray(data.fragments)) {
            taleContainer.textContent = 'Tale loading failed X(!';
            return;
        }

        renderMeta(metaContainer, data.tale);
        renderFragments(taleContainer, data.fragments);
    } catch (err) {
        console.error('Failed to load tale:', err);
        taleContainer.textContent = 'Tale loading failed XP!';
    }
};

function renderMeta(container, tale) {

    container.className = 'tale-meta';

    const rawDateBegin = tale.createdAt;
    const rawDateEnd = tale.finishedAt;

    const dateBegin = formatDate(rawDateBegin);
    const dateEnd = formatDate(rawDateEnd);

    container.innerHTML = `
        <h1 class="tale-title">${tale.title}</h1>

        <div class="meta-tale-info">
            <span><strong>Theme:</strong>${tale.theme ?? '--'}</span>
            <span><strong>Begin:</strong>${dateBegin}</span>
            <span><strong>Finished:</strong>${dateEnd ?? '--'}</span>
            ${tale.keyword ? `<span><strong>Keyword:</strong>${tale.keyword}</span>` : ''}
        </div>
    `;
}

function renderFragments(container, fragments) {
    container.innerHTML = '';

    fragments.forEach((fragment, index) => {
        const block = document.createElement('article');
        block.className = 'tale-chapter';

        block.innerHTML = `
            <h4>Chapter: ${index + 1}</h4>
            <p>${fragment.fragment}</p>
            <footer>
                <small>
                    <strong>Author: </strong>${fragment.author_name}
                    . <strong>Date: </strong>${fragment.created_at}
                </small>
            </footer>
        `;

        container.appendChild(block);
    });
}
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}