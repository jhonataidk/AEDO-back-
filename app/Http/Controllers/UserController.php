<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarUsuarioRequest;
use App\Interfaces\EnderecoServiceInterface;
use Illuminate\Http\Request;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;
    protected $enderecoService;

    public function __construct(UserServiceInterface $userService, EnderecoServiceInterface $enderecoService)
    {
        $this->userService = $userService;
        $this->enderecoService = $enderecoService;
    }

    /**
     * Lista todos os usuários com paginação.
     */
    public function index(Request $request)
    {


        $users = $this->userService->getAllUsers();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de usuários retornada com sucesso!',
            'data' => $users,
            ],200
        );
    }

    /**
     * Exibe os detalhes de um usuário específico.
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Detalhes do usuário retornados com sucesso!',
            'data' => $user,
        ], 200);
    }

    /**
     * Armazena um novo usuário.
     */
    public function store(CriarUsuarioRequest $request)
    {
        $endereco = $this->enderecoService->createEndereco($request->endereco);

        // Hash the password
        $hashedPassword = bcrypt($request->password);

        // Log the hashed password (only for debugging)
        Log::info("Hashed password: " . $hashedPassword);

        $user_data  = [
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $hashedPassword,
            'telefone' => $request->telefone,
            'id_perfil' => $request->id_perfil,
            'id_endereco' => $endereco->id,
        ];

        // Create the user
        $user = $this->userService->createUser($user_data);

        return response()->json([
            'status' => 201,
            'message' => 'Usuário criado com sucesso!',
            'user' => $user,
        ], 201);
    }


    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'telefone' => 'sometimes|string|max:20',
            'id_endereco' => 'sometimes|exists:enderecos,id',
            'id_perfil' => 'sometimes|exists:perfil,id',
        ]);

        $user = $this->userService->updateUser($validatedData, $id);

        return response()->json([
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user,
        ], 200);
    }

    /**
     * Remove um usuário.
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'status' => 200,
            'message' => 'Usuário removido com sucesso!',
        ], 200);
    }
}
