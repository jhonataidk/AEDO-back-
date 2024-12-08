<?php

namespace App\Services;

use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * Retorna todos os usuários com paginação.
     */
    public function getAllUsers()
    {
        return User::with(['perfil', 'endereco'])->get();
    }

    /**
     * Retorna um usuário específico pelo ID.
     */
    public function getUserById($id)
    {
        return User::with(['perfil', 'endereco'])->findOrFail($id);
    }

    /**
     * Cria um novo usuário.
     */
    public function createUser( array $data)
    {
        return User::create($data);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function updateUser(array $data, $id)
    {
        $user = User::findOrFail($id);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user;
    }

    /**
     * Exclui um usuário pelo ID.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return true;
    }
}
