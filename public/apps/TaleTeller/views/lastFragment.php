<?php
$taleId = $_GET['tale'] ?? null;
?>

<section class="fragment-box">

    <div id="fragMeta"></div>
    <div id="textFragment"></div>

    <p id="errorMessage" class="error-message" style="display:none"></p>

    <div class="home-actions">

        <button id="btnContinue" class="btn" style="display:block">Continue</button>

        <form id="taleForm" data-tale-id="<?= $taleId ?>">
            <?php require_once 'partials/fragmentForm.php'; ?>
        </form>
    </div>
</section>