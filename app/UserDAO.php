<?php
namespace App;

class UserDAO {
    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Get all projects
     * @return type
     */
    public function getUser($userId) {
        $stmt = $this->pdo->prepare('SELECT user_id, password, upload_dir, thumbs_upload_dir FROM tbl_user WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $userId]);
        $users = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($users, new User($row['user_id'], $row['password'], $row['upload_dir'], $row['thumbs_upload_dir']));
        }
        return $users;
    }
}
