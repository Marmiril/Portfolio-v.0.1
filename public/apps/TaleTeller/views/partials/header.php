<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$viewkey = $_GET['v'] ?? 'home';
?>

<header class="main-header">
    <h1 class="app-title">TaleTeller
        <span class="app-subtitle">Collaborative Writing</span>
    </h1>

    <nav class="main-nav">
        <ul>
            <?php if (isset($_SESSION['user'])): ?>
                <li class="header-user">
                    Welcome <?= htmlspecialchars($_SESSION['user']['username']) ?>
                </li>
            <?php endif; ?>

            <?php if ($viewkey !== 'home'): ?>
                <li><a href="<?= BASE_URL ?>/index.php">Home</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])): ?>
                <?php if($viewkey !== 'profile'): ?>
                <li><a href="<?= BASE_URL ?>/index.php?v=profile">Profile</a></li>
            <?php endif; ?>
            
                <li>
                    <button type="button" id="btnLogout" class="main-nav-link">Logout</button>
                </li>
            
            <?php else: ?>
          
                <?php if ($viewkey !== 'login'): ?>
                <li><a href="<?= BASE_URL ?>/index.php?v=login">Login</a></li>
                <?php endif ?>
          
                <?php if ($viewkey !== 'register'): ?>
                <li><a href="<?= BASE_URL ?>/index.php?v=register">Register</a></li>
                <?php endif ?>
          
            <?php endif; ?>
            
            <li><a href="/index.php?v=home">Return to portfolio</a></li>

        </ul>
    </nav>
</header>

