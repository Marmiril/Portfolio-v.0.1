<?php

require_once BASE_PATH . '/core/Database.php';

class UserWriter
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(string $username, string $email, string $password): int
    {
        $sql = "INSERT INTO users (username, email, password)
                VALUES (:username, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password
        ]);
    	return (int) $this->db->lastInsertId();
    }
}

