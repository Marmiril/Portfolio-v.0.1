<?php

require_once __DIR__ . '/../config/config.php';

header ("Content-Type: application/json");

require_once __DIR__ . '/app/Services/AuthService.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method not allowed'
    ]);
}

try{

    $service = new AuthService();
    $service->logout();
    echo json_encode(['success' => true]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => ENVIRONMENT === 'development'
            ? $e->getMessage()
            : 'Internal server error'
    ]);
}
