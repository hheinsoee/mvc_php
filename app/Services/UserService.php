<?php
namespace App\Services;

use App\Models\User;
use Core\Database;

class UserService {
    protected $userModel;

    public function __construct() {
        $pdo = Database::getInstance();
        $this->userModel = new User($pdo);
    }

    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }

    public function getUserById($id) {
        return $this->userModel->getUserById($id);
    }
}