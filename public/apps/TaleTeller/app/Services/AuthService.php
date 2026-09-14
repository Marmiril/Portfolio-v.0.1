<?php

require_once BASE_PATH . '/app/Repositories/UserReader.php';
require_once BASE_PATH . '/app/Repositories/UserWriter.php';

class AuthService
{
    private UserReader $userReader;
    private UserWriter $userWriter;

    public function __construct()
    {
        $this->userReader = new UserReader();
        $this->userWriter = new UserWriter();
    }

    public function login(array $data): array
    {
        if (empty($data['email']) || empty($data['password'])) { throw new RuntimeException('Invalid data'); }
        $user = $this->userReader->findByEmail($data['email']);
        if (!$user) { throw new RuntimeException('User not found'); }
        if (!password_verify($data['password'], $user['password'])) { throw new RuntimeException('Invalid credentials'); }
        unset($user['password']);
        return $user;
    }

    public function register(array $data): int
    {
        if (empty($data['username']) || empty($data['email'] || empty($data['password']))) { throw new RuntimeException('Ivalid data'); }
        if ($this->userReader->findUserByName($data['username'])) { throw new RuntimeException('Username already exists'); }
        if ($this->userReader->findByEmail($data['email'])) { throw new RuntimeException('Email already exists'); }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->userWriter->create($data['username'], $data['email'], $hashedPassword);
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

}

