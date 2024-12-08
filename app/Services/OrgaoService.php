<?php

namespace App\Services;

use App\Interfaces\HospitalServiceInterface;
use App\Interfaces\HospitalUsuarioServiceInterface;
use App\Interfaces\OrgaoServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Interfaces\UsuarioOrgaoServiceInterface;
use App\Models\Orgao;
use Illuminate\Support\Facades\DB;

class OrgaoService implements OrgaoServiceInterface
{
    protected HospitalServiceInterface $hospitalService;
    protected UserServiceInterface $usuarioService;
    protected UsuarioOrgaoServiceInterface $usuarioOrgaoService;
    protected HospitalUsuarioServiceInterface $hospitalUsuarioService;

    public function __construct(
        HospitalServiceInterface $hospitalService,
        UserServiceInterface $usuarioService,
        UsuarioOrgaoServiceInterface $usuarioOrgaoService,
        HospitalUsuarioServiceInterface $usuarioHospitalService
    ) {
        $this->hospitalService = $hospitalService;
        $this->usuarioService = $usuarioService;
        $this->usuarioOrgaoService = $usuarioOrgaoService;
        $this->hospitalUsuarioService = $usuarioHospitalService;
    }

    public function getAllOrgaos()
    {
        return Orgao::get();
    }

    public function getOrgaoById($id)
    {
        return Orgao::select(['id', 'nome', 'para_doacao'])
        ->findOrFail($id);
    }

    public function createOrgao(array $data)
    {
        DB::beginTransaction();

        try {
            // Verifica o usuário
            $usuario = $this->usuarioService->getUserById($data['id_usuario']);
            if (!$usuario) {
                throw new \Exception('Usuário não encontrado.');
            }

            // Verifica o hospital
            $hospital = $this->hospitalService->getHospitalById($data['id_hospital']);
            if (!$hospital) {
                throw new \Exception('Hospital não encontrado.');
            }

            // Criação do órgão
            $orgao = Orgao::create([
                'nome' => $data['nome'],
                'para_doacao' => $data['para_doacao'],
            ]);

            // Relaciona usuário e órgão
            $this->usuarioOrgaoService->create([
                'id_usuario' => $usuario->id,
                'id_orgao' => $orgao->id,
            ]);

            // Relaciona usuário e hospital
            $this->hospitalUsuarioService->create([
                'id_usuario' => $usuario->id,
                'id_hospital' => $hospital->id,
            ]);

            DB::commit();

            return $orgao;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao criar o órgão: ' . $e->getMessage());
        }
    }

    public function updateOrgao(array $data, $id)
    {
        $orgao = Orgao::findOrFail($id);
        $orgao->update($data);

        return $orgao;
    }

    public function deleteOrgao($id)
    {
        $orgao = Orgao::findOrFail($id);
        $orgao->delete();

        return true;
    }
}
