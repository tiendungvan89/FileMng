<?php
namespace App;

class User {
    private $userId = '';
    private $password = '';
    private $uploadDir = '';
    private $uploadTbumbDir = '';

    public function __construct($userId, $password, $uploadDir, $uploadTbumbDir) {
        $this->userId = $userId;
        $this->password = $password;
        $this->uploadDir = $uploadDir;
        $this->uploadTbumbDir = $uploadTbumbDir;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUploadDir() {
        return $this->uploadDir;
    }

    public function getUploadTbumbDir() {
        return $this->uploadTbumbDir;
    }
}