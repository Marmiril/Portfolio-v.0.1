<?php

function requiredAuth(): array
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (empty($_SESSION['user'])) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'error' => 'Authentication required'
        ]);
        exit;
    }

    return $_SESSION['user'];

}
