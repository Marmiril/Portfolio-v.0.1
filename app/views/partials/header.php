<?php
$currentView = $_GET['v'] ?? 'home';
?>

<header class="header">

    <div class="header-container">

        <div class="logo">
            <a href="<?= INDEX_URL ?>?v=home">
                Ángel Plata Benítez
            </a>
        </div>

        <nav>
            <?php if ($currentView !== 'home'): ?>
                <a href="<?= INDEX_URL ?>?v=home">Home</a>
            <?php endif ?>
            <?php if ($currentView !== 'gallery'): ?>
                <a href="<?= INDEX_URL ?>?v=gallery">Gallery</a>
            <?php endif ?>
            <?php if ($currentView !== 'writsList'): ?>
                <a href="<?= INDEX_URL ?>?v=writsList">Writings</a>
            <?php endif ?>
            <?php if ($currentView !== 'minigames'): ?>
                <a href="<?= INDEX_URL ?>?v=minigames">Minigames</a>
            <?php endif ?>
        </nav>
    </div>
</header>
