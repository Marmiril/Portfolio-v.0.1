<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/getTales-error.log');
error_reporting(E_ALL);

require_once __DIR__ . "/../config/config.php";

header('Content-Type: application/json');

require_once BASE_PATH . '/app/Repositories/MetaReader.php';
require_once BASE_PATH . '/app/Repositories/FragmentReader.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'succesS' => false,
        'error' => 'Request method invalid'
    ]);
}

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$user = $_SESSION['user'] ?? null;

$metaReader = new MetaReader();
$fragmentReader = new FragmentReader();

try {

    $openTales = $metaReader -> getOpenTales();
    $closeTales = $metaReader -> getCloseTales();

    $collaboratedSet = [];

    if ($user) {
        $collaboratedIds = $fragmentReader->getCollaboratedTalesIdByUser((int)$user['id']);
        $collaboratedSet = array_flip($collaboratedIds);
    }

    $result = [
        'open' => ['home' => [], 'profile' => []],
        'close' => ['home' => [], 'profile' => []]
    ];

    foreach($openTales as $tale) {
        if ($user && isset($collaboratedSet[$tale['id']])) { $result['open']['profile'][] = $tale; }
        else { $result['open']['home'][] = $tale; }
    }

    foreach($closeTales as $tale) {
        if ($user && isset($collaboratedSet[$tale['id']])) { $result['close']['profile'][] = $tale; }
        else { $result['close']['home'][] = $tale; }
    }

    echo json_encode([
        'success' => true,
        'data' => $result
    ]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'succes' => false,
        'error' => ENVIRONMENT === 'development'
            ? $e->getMessage()
            : 'Server error'
    ]);

}
