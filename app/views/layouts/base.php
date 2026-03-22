<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/portfolio/assets/css/style.css">
</head>

<body>

    <?php require BASE_PATH . '/app/views/partials/header.php'; ?>

    <main class="main">
        <?php require $view; ?>
    </main>

    <?php require BASE_PATH . '/app/views/partials/footer.php'; ?>

    <!-- JS Global -->
    <script type="module" src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>