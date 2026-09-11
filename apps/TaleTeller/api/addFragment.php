<?php

require_once __DIR__ . '/../config.php';

header("Content-Type: application/json");

require_once BASE_PATH . '/helpers/auth.php';
require_once BASE_PATH . '/app/Services/TaleProgressService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}

$user = requiredAuth();

$required = ['tale_id', 'fragment'];
foreach($required as $field) {
    if (!isset($_POST[$field])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'error' => "Missing {$field}"
        ]);
    }
}

$data = [
    'tale_id' => (int)$_POST['tale_id'],
    'author' => (int)$user['id'],
    'fragment' => trim($_POST['fragment'])
];

try {
    $service = new TaleProgressService();
    $service->addFragment($data);

    echo json_encode(['success' => true]);

} catch (RuntimeException $e) {
    http_response_code(409);
    echo json_encode ([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    
} catch (Throwable $e) {
    http_response_code(500);
        echo json_encode ([
        'success' => false,
        'error' => ENVIRONMENT === 'development'
            ? $e->getMessage()
            : 'Server error'
    ]);
}
