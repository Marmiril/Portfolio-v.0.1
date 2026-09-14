<?php

require_once __DIR__ . '/../config/config.php';

header("Content-Type: application/json");

require_once BASE_PATH . '/app/Services/AuthService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Metho not allowed'
    ]);
    exit;
}

$required = ['username', 'email', 'password'];

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
    'username' => trim($_POST['username']),
    'email'    => trim($_POST['email']),
    'password' => $_POST['password']
];

if (!$data['username'] || !$data['email'] || !$data['password']) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Fields cannot be empty'
    ]);
    
    exit;
}

try {
    $service = new AuthService();
    $user_id = $service->register($data);

    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => $user_id,
        'username'=> $data['username'],
        'email' => $data['email']
    ];
    echo json_encode([
        'success' => true,
        'user_id' => $user_id
    ]);
} catch (RuntimeException $e) {
    http_response_code(409);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} catch(Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => ENVIRONMENT === 'development'
            ? $e->getMessage()
            : 'Server error'
    ]);
}

