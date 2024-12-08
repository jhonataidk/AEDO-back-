<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarOrgaoRequest;
use Illuminate\Http\Request;
use App\Interfaces\OrgaoServiceInterface;

class OrgaoController extends Controller
{
    protected $orgaoService;

    public function __construct(OrgaoServiceInterface $orgaoService)
    {
        $this->orgaoService = $orgaoService;
    }

    // Lista todos os órgãos.

    public function index()
    {
        $orgaos = $this->orgaoService->getAllOrgaos();
        return response()->json([ 'status' => 200,
        'mensagem' => 'Detalhes do órgão retornados com sucesso!',
        'data' => $orgaos,]);
    }

    // Exibe um órgão específico.

    public function show($id)
    {
        $orgao = $this->orgaoService->getOrgaoById($id);
        return response()->json($orgao, 200);
    }

    // Armazena um novo órgão.

    public function store(CriarOrgaoRequest $request)
    {
        $validatedData = $request->validated();

        $orgao = $this->orgaoService->createOrgao($validatedData);

        return response()->json([
            'status' => 201,
            'mensagem' => 'Órgão cadastrado com sucesso!',
            'orgao' => $orgao,
        ], 201);
    }

    // Atualiza um órgão existente.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'para_doacao' => 'sometimes|boolean',
            'id_endereco' => 'sometimes|exists:enderecos,id',
            'id_user' => 'sometimes|exists:users,id',
        ]);

        $orgao = $this->orgaoService->updateOrgao($validatedData, $id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Órgão atualizado com sucesso!',
            'orgao' => $orgao,
        ], 200);
    }

    // Remove um órgão.

    public function destroy($id)
    {
        $this->orgaoService->deleteOrgao($id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Órgão removido com sucesso!',
        ], 200);
    }
}
