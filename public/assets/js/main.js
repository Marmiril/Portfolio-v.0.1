const params = new URLSearchParams(window.location.search);
const view = params.get('v');

if (view === 'gallery') {
    const { initGalleryController } = await import('./controllers/galleryController.js');
    initGalleryController();
}
