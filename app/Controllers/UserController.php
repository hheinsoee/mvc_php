<?php

namespace App\Controllers;

use App\Models\User;
use Core\Responder;

class UserController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Handle getting all users
    public function index()
    {
        $users = $this->userModel->getAllUsers();
        Responder::success($users);
    }

    // Handle getting a single user by ID
    public function show($id)
    {
        $user = $this->userModel->getUserById($id);

        if ($user) {
            Responder::success($user);
        } else {
            Responder::notFound("User with ID $id not found");
        }
    }
}
