<?php

require_once __DIR__ . '/../config/config.php';

header("Content-Type: application/json");

require_once BASE_PATH . '/helpers/auth.php';
require_once BASE_PATH . '/app/Repositories/MetaReader.php';
require_once BASE_PATH . '/app/Services/TaleProgressService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
    exit;
}

$user = requiredAuth();

if (!isset($_GET['tale_id'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Missing tale id'
    ]);
    exit;
}

$tale_id = (int)$_GET['tale_id'];
$metaReader = new MetaReader();

$meta = $metaReader->findById($tale_id);
if (!$meta) {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'error' => 'Tale not found'
    ]);
    exit;
}

try {
    $service = new TaleProgressService();
    $service->validateCollaboration($tale_id, (int)$user['id']);

    echo json_encode([
        'success' => true,
        'canCollaborate' => true
    ]);
} catch (RuntimeException $e) {
    echo json_encode([
        'success' => true,
        'canCollaborate' => false,
        'error' => $e->getMessage()
    ]);
}
