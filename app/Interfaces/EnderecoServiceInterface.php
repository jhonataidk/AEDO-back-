<?php

namespace App\Interfaces;

interface EnderecoServiceInterface
{
    public function getAllEnderecos();
    public function getEnderecoById($id);
    public function createEndereco(array $data);
    public function updateEndereco(array $data, $id);
    public function deleteEndereco($id);
}
