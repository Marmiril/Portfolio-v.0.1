<?php

require_once BASE_PATH . '/core/Database.php';

class FragmentReader
{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function getByTaleId(int $taleId): array
    {
        $sql = "SELECT c.*, u.username AS author_name
                FROM collaborations c
                JOIN users u ON u.id = c.author
                WHERE c.tale_id = :tale_id
                ORDER BY c.step_number ASC ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tale_id' => $taleId]);
        return $stmt->fetchAll();
    }

    // NUMBER OF FRAGMENTS BY TALE ID
    public function countByTaleId(int $tale_id): int
    {
        $sql = "SELECT COUNT(*) FROM collaborations WHERE tale_id = :tale_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tale_id' => $tale_id]);
        return $stmt->fetchColumn();
    }

    public function hasCollaborated(int $tale_id, int $user_id): bool
    {
        $sql = "SELECT 1 FROM collaborations WHERE tale_id = :tale_id AND author = :author LIMIT 1";
        $stmt =$this->db->prepare($sql);
        $stmt->execute([
            ':tale_id' => $tale_id,
            ':author' => $user_id
        ]);
        return $stmt->fetchColumn();
    }

    public function getCollaboratedTalesIdByUser(int $userId): array
    {
        $sql = "SELECT DISTINCT tale_id
                FROM collaborations
                WHERE author = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getFragmentMeta(int $tale_id): ?array
    {
        $sql = "SELECT
                c.fragment,
                c.step_number,
                c.created_at,
                u.username AS author_name,
                t.title,
                t.keyword
                FROM collaborations c
                JOIN user u ON u.id = c.author,
                JOIN tales t ON t.id = c.tale_id
                WHERE c.tale_id = :tale_id
                ORDER BY c.step_number DESC
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':tale_id' => $tale_id]);
        return $stmt->fetch() ?: null;
    }
}
