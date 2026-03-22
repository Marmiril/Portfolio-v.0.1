<?php
$writsDir = BASE_PATH . '/app/data/writings';
$files = scandir($writsDir); // scandir se encarga de listar los archivos.
?>

<section class="gallery">

    <div class="gallery-header">
        <h1>The Writings</h1>
    </div>

    <div class="gallery-grid">
        <?php foreach ($files as $file): ?>

            <?php
            if (pathinfo($file, PATHINFO_EXTENSION) !== 'txt') continue;

            $id = pathinfo($file, PATHINFO_FILENAME);
            $path = $writsDir . '/' . $file;

            $lines = file($path);
            $title = trim($lines[0] ?? 'Sin título');

            $img = BASE_URL . "/assets/img/writings/$id.jpg";
            ?>

            <a href="<?= BASE_URL ?>/public/index.php?v=writing&id=<?= $id ?>" class="gallery-item">

                <img src="<?= $img ?> " alt="<?= htmlspecialchars($title) ?>">

                <h3 class="writing-title">
                    <?= htmlspecialchars($title) ?>
                </h3>

            </a>

        <?php endforeach ?>

    </div>

</section>