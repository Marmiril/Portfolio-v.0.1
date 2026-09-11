<?php
require_once BASE_PATH . '/core/Database.php';

class UserReader {
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function findUserByName(string $username): ?array
    {
        $sql = 'SELECT * FROM users WHERE username = :username LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt -> execute([':username' => $username]);
        return $stmt->fetch() ?: null;
    }
}
