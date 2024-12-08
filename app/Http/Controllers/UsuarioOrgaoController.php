<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioOrgaoRequest;
use App\Interfaces\UsuarioOrgaoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UsuarioOrgaoController extends Controller
{
    private UsuarioOrgaoServiceInterface $service;

    public function __construct(UsuarioOrgaoServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de usuários de órgãos retornada com sucesso!',
            'data' => $this->service->getAll()
        ], 200);

    }

    public function store(UsuarioOrgaoRequest $request): JsonResponse
    {
        $data = $request->validated();
        $usuarioOrgao = $this->service->create($data);
        return response()->json(
            [
                'status' => 201,
                'mensagem' => 'Usuário de órgão criado com sucesso!',
                'data' => $usuarioOrgao
            ],
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $usuarioOrgao = $this->service->getById($id);
        return response()->json($usuarioOrgao);
    }

    public function update(UsuarioOrgaoRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $usuarioOrgao = $this->service->update($id, $data);
        return response()->json($usuarioOrgao);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    public function showByUser(int $id): JsonResponse
    {
        $usuarioOrgao = $this->service->getByUserId($id);
        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de usuários de órgãos retornada com sucesso!',
            'data' => $usuarioOrgao
        ], 200);
    }

}
