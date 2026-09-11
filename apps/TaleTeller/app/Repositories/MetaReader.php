<?php

require_once BASE_PATH . '/core/Database.php';

class MetaReader {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // META BY ID
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM tales WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    // META BY TITLE
    public function findByTitle(string $title): ?array
    {
        $sql = "SELECT * FROM tales WHERE title = :title LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title' => $title]);
        return $stmt->fetch() ?: null;
    }

    // EXISTS BY TITLE
    public function existsByTitle(string $title): bool
    {
        $sql = "SELECT 1 FROM tales WHERE title = :title LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title' => $title]);
        return (bool) $stmt->fetchColumn();
    }

    // GET LAST STEPNUMBER
    public function getLastStepNumber(int $tale_id): int
    {
        $sql = "SELECT step_number FROM collaborations WHERE tale_id = :tale_id ORDER BY set_number DES LIMIT1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tale_id' => $tale_id ]);
        return (int) ($stmt->fetchColumn() ?? 0) ;
    }

    // IS FINISHED
    public function isFinished(int $tale_id): bool
    {
        $sql = "SELECT 1 FROM tales WHERE id = :id AND finishedAt IS NOT NULL LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $tale_id]);
        return (bool) $stmt->fetchColumn();
    }

    // UNFINISHED
    public function getOpenTales(): array
    {
        $sql = "SELECT t.*, username AS author
        FROM tales t
        JOIN users u ON u.id = t.author
        WHERE t.finishedAt IS NULL ORDER BY t.createdAt DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // FINISHED TALES
    public function getCloseTales(int $limit = 100): array
    {
        $sql = "SELECT t.*, username AS author
        FROM tales t
        JOIN users u ON u.id = t.author
        WHERE t.finishedAt IS NOT NULL ORDER BY t.finishedAt DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
