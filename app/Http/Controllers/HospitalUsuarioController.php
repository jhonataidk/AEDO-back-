<?php
namespace App\Http\Controllers;

use App\Http\Requests\HospitalUsuarioRequest;
use App\Interfaces\HospitalUsuarioServiceInterface;
use Illuminate\Http\JsonResponse;

class HospitalUsuarioController extends Controller
{
    private HospitalUsuarioServiceInterface $service;

    public function __construct(HospitalUsuarioServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    public function store(HospitalUsuarioRequest $request): JsonResponse
    {
        $data = $request->validated();
        $hospitalUsuario = $this->service->create($data);
        return response()->json($hospitalUsuario, 201);
    }

    public function show(int $id): JsonResponse
    {
        $hospitalUsuario = $this->service->getById($id);
        return response()->json($hospitalUsuario);
    }

    public function update(HospitalUsuarioRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $hospitalUsuario = $this->service->update($id, $data);
        return response()->json($hospitalUsuario);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
