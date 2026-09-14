<?php

require_once __DIR__ . "/core/Database.php";
require_once __DIR__ . "/../config/config.php";

header('Content-Type: application/json');

require_once BASE_PATH . '/app/Repositories/FragmentReader.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET'){
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
    exit;
}

if (!isset($_GET['tale_id'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Missing tale id'
    ]);
}

$taleId = (int)$_GET['tale_id'];

try {
    $fragmentReader = new FragmentReader();
    $fragMeta = $fragmentReader->getFragmentMeta($taleId);

    if(!$fragMeta) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'error' => 'No fragments found for this tale'
        ]);
        exit;
    }

    echo json_encode([
        'success' => true,
        'fragMeta' => $fragMeta
    ]);
    
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => ENVIRONMENT === 'development'
            ? $e->getMessage()
            : 'Server error'
    ]);
}


