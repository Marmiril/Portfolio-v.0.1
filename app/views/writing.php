<?php 

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(404);
    exit('Writing not found!');
}

$file = BASE_PATH . "/app/data/writings/$id.txt";

if (!file_exists($file)) {
    http_response_code(404);
    exit("Writing not found!");
}

$bg =  BASE_URL . "/assets/img/writings/$id.jpg";

$lines = file($file);
$title = trim($lines[0] ?? "Untitiles");

// Separación de título y separador.
$contentLines = array_slice($lines, 2);

// Conversión a HTML básico
$content = '';

    foreach($contentLines as $line) {
        $line = trim($line);
        if ($line !== '') {
            $content .='<p>' . htmlspecialchars($line) . '</p>';
        }
    }
?>
<section class="writing-wrapper">
<div class="writing-bg" style="background-image: url('<?= $bg ?>')"></div>
    

    <div class="writing">
        <h1><?= htmlspecialchars($title) ?></h1>

        <div class="writing-content">
            <?= $content ?>
        </div>
    </div>

</section>