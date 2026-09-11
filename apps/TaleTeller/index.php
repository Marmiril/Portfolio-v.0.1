<?php

require_once __DIR__ . '/config/config.php';

$viewKey = $_GET['v'] ?? 'home';

$views = [
    'home' => __DIR__ . '/views/home.php',
    'login' => __DIR__ . '/views/login.php',
    'register' => __DIR__ . '/views/register.php',
    'create' => __DIR__ . '/views/taleForm.php',
    'fragment' => __DIR__ . '/views/lastFragment.php',
    'profile' => __DIR__ . '/views/profile.php',
    'consult' => __DIR__ . '/views/viewTale.php'
];

if (!isset($views[$viewKey])) {
    http_response_code(404);
    exit('View not found!');
}

$view = $views[$viewKey];

require_once __DIR__ . '/views/layouts/base.php';
