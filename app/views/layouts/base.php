
<?php
if(!isset($view)) {
    http_response_code(500);
    exit('View not defined');
}
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portfolio</title>
        
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    </head>

    <body>

        <?php require_once BASE_PATH . '/app/views/partials/header.php'; ?>

        <main class="main">
            <?php require_once $view; ?>
        </main>

        <?php require_once BASE_PATH . '/app/views/partials/footer.php'; ?>

        <!-- JS Global -->
         <script type="module" src="<?= BASE_URL ?>/assets/js/main.js"></script>

    </body>

</html>
