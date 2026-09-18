<?php

require_once __DIR__ . '/../config/config.php';

header("Content-Type: application/json");

require_once BASE_PATH . ("/helpers/auth.php");
require_once BASE_PATH . ("/app/Services/MetaService.php");
require_once BASE_PATH . ("/app/Repositories/FragmentWriter.php");
require_once BASE_PATH . ("/core/Database.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
    exit;
}

$user = requiredAuth();

$data = [
    'title' => trim($_POST['title']),
    'author' => (int)$user['id'],
    'steps' => (int)$_POST['steps'],
    'theme' => trim($_POST['theme']),
    'keyword' => isset($_POST['keyword']) && trim($_POST['keyword']) !== ''
        ? trim ($_POST['keyword'])
        : null,
    'fragment' => trim($_POST['fragment'])
];

$db = Database::getConnection();

try {
    $db->beginTransaction();

    $metaService = new MetaService();
    $taleId = $metaService->create($data);

    $fragmentWriter = new FragmentWriter();
    $fragmentWriter->create([
        'tale_id' => $taleId,
        'author' => $data['author'],
        'fragment' => $data['fragment'],
        'step_number' => 1
    ]);

    $db->commit();
    echo json_encode([
        'success' => true,
        'tale_id' => $taleId
    ]);

    exit;
} catch (RuntimeException $e) {
    $db->rollBack();
    http_response_code(409);
    echo json_encode([
        'success' => false,
        'error' => ENVIRONMENT === 'development'
            ? $e->getMessage()
            : 'Server error'
    ]);
}
