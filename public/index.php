<?php

// config.php load
require_once dirname(__DIR__) . '/config/config.php';

// View
$viewKey = $_GET['v'] ?? 'home';

// Views map
$views = [
    'home'      => BASE_PATH . '/app/views/home.php',
    'skills'    => BASE_PATH . '/app/views/skills.php',
    'projects'  => BASE_PATH . '/app/views/projects.php',
    'minigames' => BASE_PATH . '/app/views/minigames.php'
];

// Validation
if (!isset($views[$viewKey])) {
    http_response_code(404);
    exit('View not found');
}

$view = $views[$viewKey];

// Render layout
require_once BASE_PATH . '/app/views/layouts/base.php';
