<?php
namespace App\Services;

use App\Interfaces\EnderecoServiceInterface;
use App\Interfaces\HospitalServiceInterface;
use App\Models\Hospital;
use App\Models\Endereco;

class HospitalService implements HospitalServiceInterface
{

    protected $enderecoService;

    public function __construct(EnderecoServiceInterface $enderecoService)
    {
        $this->enderecoService = $enderecoService;
    }
    public function getAllHospitais()
    {
        return Hospital::with('endereco')->get();
    }

    public function getHospitalById($id)
    {
        return Hospital::with('endereco')->findOrFail($id);
    }

    public function createHospitalWithEndereco(array $hospitalData, array $enderecoData)
    {
        // Criação do endereço
        $endereco = $this->enderecoService->createEndereco($enderecoData);

        // Criação do hospital vinculado ao endereço
        $hospitalData['id_endereco'] = $endereco->id;
        return Hospital::create($hospitalData);
    }

    public function updateHospital(array $data, $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update($data);
        return $hospital;
    }

    public function deleteHospital($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
    }
}
