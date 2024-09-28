<?php

namespace App\Controllers;

use App\Services\UserService;
use Core\Responder;

class UserController
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    // Handle GET request for all users
    public function index()
    {
        $users = $this->userService->getAllUsers();
        Responder::success($users);
    }

    // Handle GET request for a user by ID
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        
        if ($user) {
            Responder::success($user);
        } else {
            Responder::notFound("User not found.");
        }
    }
}
