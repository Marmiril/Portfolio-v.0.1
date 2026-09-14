<?php

require_once BASE_PATH . '/core/Database.php';

class FragmentWriter
{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function create(array $data): void
    {
        $sql = "INSERT INTO collaborations (tale_id, author, fragment, step_number)
                VALUES (:tale_id, :author, :fragment, :step_number)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
           ':tale_id' => $data['tale_id'] ,
           ':author' => $data['author'],
           ':fragment' => $data['fragment'],
           ':step_number' => $data['step_number']
        ]);
    }
}
