<?php
$currentView = $_GET['v'] ?? 'home';
?>

<header class="header">
    <div class="header-container">

        <div class="logo">
            <a href="<?= BASE_URL ?>/public/index.php?v=home">
                Ángel Plata Benítez
            </a>
        </div>
        <nav>
            <?php if ($currentView !== 'home'): ?>
                <a href="<?= BASE_URL ?>/public/index.php?v=home">Home</a>
            <?php endif ?>

            <?php if ($currentView !== 'gallery'): ?>
                <a href="<?= BASE_URL ?>/public/index.php?v=gallery">Gallery</a>
            <?php endif ?>

            <?php if($currentView !== 'writsList'): ?>
                <a href="<?= BASE_URL ?>/public/index.php?v=writsList">Writings</a>
            <?php endif ?>

            <?php if($currentView !== 'minigames'): ?>
                <a href="<?= BASE_URL ?>/public/index.php?v=minigames">Minigames</a>
            <?php endif ?>

            <a href="<?= BASE_URL ?>/public/index.php?v=skills">Skills</a>
            <a href="<?= BASE_URL ?>/public/index.php?v=projects">Projects</a>            
        </nav>
    </div>
</header>