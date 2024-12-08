<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarHospitalComEnderecoRequest;
use App\Interfaces\HospitalServiceInterface;
use http\Client\Request;
use Illuminate\Http\JsonResponse;

class HospitalController extends Controller
{
    protected $hospitalService;

    public function __construct(HospitalServiceInterface $hospitalService)
    {
        $this->hospitalService = $hospitalService;
    }

    // Lista todos os hospitais.
    public function index(): JsonResponse
    {
        $hospitais = $this->hospitalService->getAllHospitais();
        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de hospitais retornada com sucesso!',
            'data' => $hospitais,
        ], 200);

    }

    // Exibe um hospital específico.
    public function show($id): JsonResponse
    {
        $hospital = $this->hospitalService->getHospitalById($id);
        return response()->json([
            'status' => 200,
            'mensagem' => 'Detalhes do hospital retornados com sucesso!',
            'data' => $hospital,
        ]
        , 200);
    }

    // Cria um novo hospital com endereço.
    public function store(CriarHospitalComEnderecoRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        // Obter o ID do usuário autenticado
        $hospitalData = [
            'nome' => $validatedData['nome'],
            'telefone' => $validatedData['telefone'],
            'email' => $validatedData['email'],
            'criado_por' => auth()->id(), // Preenchido automaticamente
        ];
        $enderecoData = $validatedData['endereco'];

        $hospital = $this->hospitalService->createHospitalWithEndereco($hospitalData, $enderecoData);

        return response()->json([
            'status' => 201,
            'mensagem' => 'Hospital e endereço cadastrados com sucesso!',
            'hospital' => $hospital,
        ], 201);
    }

    // Atualiza um hospital existente.
    public function update(\Illuminate\Http\Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'telefone' => 'sometimes|string|max:20',
            'email' => 'sometimes|email|unique:hospitais,email,' . $id,
        ]);

        $hospital = $this->hospitalService->updateHospital($validatedData, $id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Hospital atualizado com sucesso!',
            'hospital' => $hospital,
        ], 200);
    }

    // Remove um hospital.
    public function destroy($id): JsonResponse
    {
        $this->hospitalService->deleteHospital($id);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Hospital removido com sucesso!',
        ], 200);
    }
}
