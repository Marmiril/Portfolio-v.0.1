<?php

declare(strict_types=1);

require_once __DIR__ . '/core/Database.php';

try {
    $db = Database::getConnection();

    $stmt = $db->query('SELECT 1 AS test');
    $result = $stmt->fetch();

    echo '<h1>Database class OK</h1>';
    echo '<p>Connection through core/Database.php works</p>';
    echo '<pre>';
    print_r($result);
    echo '</pre>';
} catch(Throwable $e) {
    echo '<h1>Database class FAILED</h1>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
}
