export async function initLastFragmentController() {

    const metaContainer = document.getElementById('fragMeta');
    const container = document.getElementById('textFragment');
    if (!container || !metaContainer) return;

    const params = new URLSearchParams(window.location.search);
    const taleId = params.get('tale');

    const btnContinue = document.getElementById('btnContinue');
    btnContinue.style.display = 'block';
    const fragmentForm = document.getElementById('fragmentForm');
    fragmentForm.style.display = 'none';

    if (btnContinue && fragmentForm) {
        btnContinue.addEventListener('click', () => {
            fragmentForm.style.display = 'block';
            btnContinue.style.display = 'none';
        });
    }

    if (!taleId) {
        container.textContent = 'Tale not found';
        return;
    }

    await loadLastFragment(taleId);
    await checkCanCollaborate(taleId);
}

async function loadLastFragment(taleId) {
    try {
        const response = await fetch(`api/getLastFragment.php?tale_id=${taleId}`);

        const data = await response.json();

        if (!data.success || !data.fragMeta) {
            fragContainer.textContent = 'Fragment loading failed!';
            return;
        }

        renderFragmentView(data.fragMeta);
    } catch (err) {
        console.error('Fragment load error:', err);
        fragContainer.textContent = 'Fragment loading failed!';
    }
}

async function checkCanCollaborate(taleId) {

    const btnContinue = document.getElementById('btnContinue');
    const publishBtn = document.getElementById('btnPublish');
    const errorBox = document.getElementById('errorMessage');

    if (!publishBtn) return;

    try {
        const res = await fetch(`api/canCollaborate.php?tale_id=${taleId}`);
        const data = await res.json();
        if (res.status === 401) return;

        if (!data.canCollaborate) {
            publishBtn.disabled = true;
            btnContinue.disabled = true;
            btnContinue.style.display = 'none';

            if (errorBox) {
                errorBox.textContent = data.error;
                errorBox.style.display = 'block';
            }
        }

        else { btnContinue.style.display = 'block'; }
    } catch (err) {
        console.error('canCollaborate error: ', err);
    }
}

function renderFragmentView(fragment) {

    const metaContainer = document.getElementById('fragMeta');
    const fragContainer = document.getElementById('textFragment');

    const rawDate = fragment.created_at;

    const date = formatDate(rawDate);

    fragContainer.textContent = fragment.fragment;
    metaContainer.className = 'frag-meta';
    metaContainer.innerHTML = `
        <h1 class="frag-tale-title">${fragment.title}</h1>

        <div class="frag-meta-info">
            <span><strong>Author:</strong>${fragment.author_name ?? '--'}</span>
            ${fragment.keyword ? `<span><strong>Keyword:</strong>${fragment.keyword}</span>` : ''}
            <span><strong>Date: </strong>${date}</span>
            <span><strong>Step nº:</strong>${fragment.step_number}</span>
        </div>
    `;
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}
