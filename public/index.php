<?php

// config.php load
require_once dirname(__DIR__) . '/config/config.php';

// View
$viewKey = $_GET['v'] ?? 'home';

// Views map
$views = [
    'home'      => BASE_PATH . '/app/views/home.php',
    'skills'    => BASE_PATH . '/app/views/skills.php',
    'gallery'   => BASE_PATH . '/app/views/gallery.php',
    'writsList' => BASE_PATH . '/app/views/writsList.php',
    'writing'   => BASE_PATH . '/app/views/writing.php',
    'projects'  => BASE_PATH . '/app/views/projects.php',
    'contact'   => BASE_PATH . '/app/views/contact.php'
];

// Validation
if (!isset($views[$viewKey])) {
    http_response_code(404);
    exit('View not found');
}

$view = $views[$viewKey];

// Render layout
require BASE_PATH . '/app/views/layouts/base.php';
