<section class="gallery">

    <div class="gallery-header">
        <h1>Gallery</h1>
    </div>

    <div class="gallery-grid">
        <?php
        $images = [
            'awards.jpg',
            'charity.jpg',
            'nobel.jpg',
            'demostration.jpg',
            'greenpeace.jpg',
            'nature_chad.jpg',
            'onu.jpg',
            'oscars.jpg',
            'pope.jpg',
            'trump.jpg',
            'volunteer.jpg'
        ];

        foreach ($images as $img): ?>
            <div class="gallery-item">
                <img
                    src="<?= BASE_URL ?>/assets/img/gallery/<?= $img ?>"
                    data-full="<?= BASE_URL ?>/assets/img/gallery/<?= $img ?>"
                    class="gallery-img">
            </div>
        <?php endforeach; ?>
    </div>
    
    <div id="lightbox" class="lightbox hidden">
        <img id="lightbox-img" src="">
    </div>
</section>