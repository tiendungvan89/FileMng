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

    /**
     * Change password
     * @return type
     */
    public function changePassword($userId, $newPassword) {
        $stmt = $this->pdo->prepare('UPDATE tbl_user SET password = :password WHERE user_id = :user_id');
        $stmt->bindValue(':password', $newPassword);
        $stmt->bindValue(':user_id' , $userId);

        return $stmt->execute();
    }

    /**
     * Change password
     * @return type
     */
    public function registerUser($userId, $password) {
        $user = null;
        $stmt = $this->pdo->prepare('INSERT INTO tbl_user(user_id, password, upload_dir, thumbs_upload_dir) '
                                                 .'VALUES(:user_id, :password, :upload_dir, :thumbs_upload_dir)');
        
        $uploadDir = sprintf("/users/%s/upload/",$userId);
        $thumbsUploadDir = sprintf("/users/%s/thumbs/",$userId);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':user_id' , $userId);
        $stmt->bindValue(':upload_dir' , $uploadDir);
        $stmt->bindValue(':thumbs_upload_dir' , $thumbsUploadDir);
        if ($stmt->execute()) {
            $user = new User($userId, $password, $uploadDir, $thumbsUploadDir);
        }

        return $user;
    }
}
