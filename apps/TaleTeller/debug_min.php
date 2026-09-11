<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo '1 OK<br>';

require_once __DIR__ . '/config/config.php';
echo '2 CONFIG OK<br>';

$view = __DIR__ . '/views/home.php';

echo '3 VIEW PATH: ' . $view . '<br>';
echo '4 VIEW EXISTS: ' . (file_exists($view) ? 'YES' : 'NO') . '<br>';

require_once __DIR__ . '/views/layouts/base.php';

echo '5 BASE OK<br>';