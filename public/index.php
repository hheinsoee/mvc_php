<?php

require '../vendor/autoload.php';

use Core\Router;
use App\Controllers\UserController;

$router = new Router();

// Define the route to get all users
$router->get('/users', [UserController::class, 'index']);

// Define the route to get a user by their ID (using a dynamic parameter {id})
$router->get('/users/{id}', [UserController::class, 'show']);

// Dispatch the request
$router->dispatch();
