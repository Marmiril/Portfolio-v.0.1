<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');
error_reporting(E_ALL);

echo "1. PHP OK<br>";

require_once __DIR__ . '/config/config.php';
echo "2. config OK<br>";

$viewKey = $_GET['v'] ?? 'home';

$views = [
    'home'     => __DIR__ . '/views/home.php',
    'login'    => __DIR__ . '/views/login.php',
    'register' => __DIR__ . '/views/register.php',
    'create'   => __DIR__ . '/views/taleForm.php',
    'fragment' => __DIR__ . '/views/lastFragment.php',
    'profile'  => __DIR__ . '/views/profile.php',
    'consult'  => __DIR__ . '/views/viewTale.php'
];

$view = $views[$viewKey] ?? null;

echo "3. view resolved: " . htmlspecialchars((string)$view) . "<br>";
echo "4. view exists: " . (file_exists($view) ? 'YES' : 'NO') . "<br>";

require __DIR__ . '/views/layouts/base.php';

echo "5. layout OK<br>";