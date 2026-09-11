<?php

require_once __DIR__ . '/../config/config.php';

header("Content-Type: application/json");

require_once BASE_PATH . '/app/Repositories/MetaReader.php';
require_once BASE_PATH . '/app/Repositories/FragementReader.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
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
        'succes' => false,
        'error' => 'Missing tale id'
    ]);
    exit;
}

$tale_id = (int) $_GET['tale_id'];

$metaReader = new MetaReader();
$fragmentReader = new FragmentReader();

$meta = $metaReader -> findById($tale_id);

if (!$meta) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Tale not found'
    ]);
    exit;
}

if (!$metaReader -> isFinished($tale_id)) {
    http_response_code(409);
    echo json_encode([
        'success' => false,
        'error' => 'Tale is not finished'
    ]);
    exit;
}

$fragment = $fragmentReader -> getByTaleId($tale_id);
if (isset($meta['author'])) {
    $stmt = Database::getConnection()->prepare('SELECT username FROM users WHERE id == :id');
    $stmt->execute([':id' => $meta['author']]);
    $authorname = $stmt->fetchColumn();
}


echo json_encode([
    'success' => true,
    'tale'    => [
        'id' => $meta['id'],
        'title' => $meta['title'],
        'theme' => $meta['theme'],
        'keyword' => $meta['keyword'],
        'steps' => (int)$meta['steps'],
        'createdAt' => $meta['createdAt'],
        'finishedAt' => $meta['finishedAt'],
        'author_name' => $authorname
    ],
    'fragments' => $fragment
]);
