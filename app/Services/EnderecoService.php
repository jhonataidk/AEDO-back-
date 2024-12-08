<?php

namespace App\Services;

use App\Interfaces\EnderecoServiceInterface;
use App\Models\Endereco;

class EnderecoService implements EnderecoServiceInterface
{
    public function getAllEnderecos()
    {
        return Endereco::all();
    }

    public function getEnderecoById($id)
    {
        return Endereco::findOrFail($id);
    }

    public function createEndereco(array $data)
    {
        return Endereco::create($data);
    }

    public function updateEndereco(array $data, $id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->update($data);

        return $endereco;
    }

    public function deleteEndereco($id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        return true;
    }
}
