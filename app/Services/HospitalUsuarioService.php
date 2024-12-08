<?php
namespace App\Services;

use App\Interfaces\HospitalUsuarioServiceInterface;
use App\Models\HospitalUsuario;

class HospitalUsuarioService implements HospitalUsuarioServiceInterface
{
    public function getAll()
    {
        return HospitalUsuario::all();
    }

    public function getById(int $id)
    {
        return HospitalUsuario::findOrFail($id);
    }

    public function create(array $data)
    {
        return HospitalUsuario::create($data);
    }

    public function update(int $id, array $data)
    {
        $hospitalUsuario = HospitalUsuario::findOrFail($id);
        $hospitalUsuario->update($data);
        return $hospitalUsuario;
    }

    public function delete(int $id)
    {
        $hospitalUsuario = HospitalUsuario::findOrFail($id);
        $hospitalUsuario->delete();
    }
}
