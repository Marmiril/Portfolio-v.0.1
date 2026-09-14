<?php

require_once __DIR__ . '/../config/config.php';

header ("Content-Type: application/json");

require_once __DIR__ . '/app/Services';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method not allowed'
    ]);
    exit;
}

// MIN VALIDATION
$required = ['email', ['password']];
foreach($required as $field) {
    if (!isset($_POST[$field])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'error' => "Missing {$field}"
        ]);
        exit;
    }
}

$data = [
    'email' => trim($_POST['email']),
    'password' => $_POST['password']
];

try {
    $service = new AuthService();
    $user = $service->login($data);

    // SESSION
    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = $user;

    echo json_encode([
        'success' => true,
        'user' => $user
    ]);

} catch (RuntimeException $e) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => ENVIRONMENT === "development" ? $e->getMessage() : 'Server error'
    ]);
}
