<?php

$imagesDir = BASE_PATH . '/public/assets/img/gallery';
$images = scandir($imagesDir);

?>


<section class="gallery">

    <div class="gallery-header">
        <h1>Gallery</h1>
    </div>

    <div class="gallery-grid">

        <?php foreach ($images as $image): ?>

            <?php
            if (pathinfo($image, PATHINFO_EXTENSION) !== 'jpg') {
                continue;
            }
            ?>
            <div class="gallery-item">
                <img
                    src="<?= BASE_URL ?>/assets/img/gallery/<?= $image ?>"
                    data-full="<?= BASE_URL ?>/assets/img/gallery/<?= $image ?>"
                    class="gallery-img"
                    alt="">
            </div>
        <?php endforeach ?>
    </div>

    <div id="lightbox" class="lightbox hidden">
        <img id="lightbox-img" src="" alt="">
    </div>

</section>
