<?php

namespace App\Interfaces;

interface HospitalServiceInterface
{
    public function getAllHospitais();
    public function getHospitalById($id);
    public function createHospitalWithEndereco(array $hospitalData, array $enderecoData);
    public function updateHospital(array $data, $id);
    public function deleteHospital($id);
}
