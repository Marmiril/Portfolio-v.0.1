<?php if (!isset($view)) { throw new RuntimeException('View not defined'); } ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>TaleTeller</title>

        <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/main.css">
        <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap" rel="stylesheet">
    </head>

    <body>
        <?php require_once __DIR__ . '/../partials/header.php'; ?>

        <main class="page-content">
            <?php require_once $view; ?>
        </main>

        <?php require_once __DIR__ . '/../partials/footer.php'; ?>

        <script type="module" src="<?=  BASE_URL ?>/public/js/main.js"></script>
    </body>

</html>
