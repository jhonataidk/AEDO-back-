<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\EnderecoServiceInterface;

class EnderecoController extends Controller
{
    protected $enderecoService;

    public function __construct(EnderecoServiceInterface $enderecoService)
    {
        $this->enderecoService = $enderecoService;
    }

    // Lista todos os endereços cadastrados.

    public function index()
    {
        $enderecos = $this->enderecoService->getAllEnderecos();
        return response()->json($enderecos, 200);
    }

    // Exibe um endereço específico estabelecido pelo id fornecido.

    public function show($id)
    {
        $endereco = $this->enderecoService->getEnderecoById($id);
        return response()->json($endereco, 200);
    }

    // Armazena um novo endereço.

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logradouro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
        ]);

        $endereco = $this->enderecoService->createEndereco($validatedData);

        return response()->json([
            'status' => 201,
            'mensagem' => 'Endereço cadastrado com sucesso!',
            'endereco' => $endereco,
        ], 201);
    }

    // Atualiza um endereço existente.

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'logradouro' => 'sometimes|string|max:255',
            'cidade' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|max:255',
            'cep' => 'sometimes|string|max:10',
        ]);

        $endereco = $this->enderecoService->updateEndereco($validatedData, $id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Endereço atualizado com sucesso!',
            'endereco' => $endereco,
        ], 200);
    }

    // Remove um endereço.

    public function destroy($id)
    {
        $this->enderecoService->deleteEndereco($id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Endereço removido com sucesso!',
        ], 200);
    }
}
