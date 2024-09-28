<?php

namespace App\Models;

class User
{
    public function getAllUsers()
    {
        // Dummy data for example
        return [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Doe']
        ];
    }

    public function getUserById($id)
    {
        $users = $this->getAllUsers();

        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }

        return null;
    }
}
