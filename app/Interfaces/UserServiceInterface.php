<?php

namespace App\Interfaces;

use http\Client\Curl\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function getAllUsers();


    public function getUserById($id);
    public function createUser(array $data);
    public function updateUser(array $data, $id);
    public function deleteUser($id);
}
