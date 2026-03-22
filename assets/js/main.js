const params = new URLSearchParams(window.location.search);
const view = params.get('v');

switch (view) {

    case 'gallery': {
        const { initGalleryController } = await import('./controllers/galleryController.js')
            initGalleryController();
            break;
    }

}