<?php

require_once BASE_PATH . '/core/Database.php';

class MetaWriter {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO tales (title, author, steps, theme, keyword)
                VALUES (:title, :author, :steps, :theme, :keyword)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'],
            ':author' => $data['author'],
            ':steps' => $data['steps'],
            ':theme' => $data['theme'],
            ':keyword' => $data['keyword'] ?? null
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function updateCurrentStep(int $tale_id, int $step): void
    {
        $sql = 'UPDATE tales SET current_step = :step WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':step' => $step,
            ':id' => $tale_id
        ]);
    }

    public function markAsFinished(int $tale_id): void
    {
        $sql = 'UPDATE tales SET current_step = steps,
                finishedAt = CURRENT_TIMESTAMP
                where id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $tale_id]);
    }
}
