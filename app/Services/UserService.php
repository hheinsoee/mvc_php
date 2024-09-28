<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Retrieve all users
    public function getAllUsers()
    {
        return $this->userModel->getAllUsers();
    }

    // Retrieve a user by ID
    public function getUserById($id)
    {
        return $this->userModel->getUserById($id);
    }
}
