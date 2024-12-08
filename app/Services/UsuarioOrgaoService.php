<?php
namespace App\Services;

use App\Http\Requests\UsuarioOrgaoRequest;
use App\Interfaces\UsuarioOrgaoServiceInterface;
use App\Models\HospitalUsuario;
use App\Models\Orgao;
use App\Models\UsuarioOrgao;
use Illuminate\Support\Facades\DB;

class UsuarioOrgaoService implements UsuarioOrgaoServiceInterface
{
    public function getAll()
    {
        return UsuarioOrgao::with(['orgao', 'usuario.perfil', 'usuario.endereco'])
            ->whereHas('usuario', function ($query) {
                $query->whereIn('id_perfil', [2, 3,1]);
            })
            ->get();
    }

    public function getById(int $id)
    {
        return UsuarioOrgao::findOrFail($id);
    }

    /**
     * Cria um órgão e associa o usuário e o hospital.
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function create(array $data): array
    {
        DB::beginTransaction();

        try {
            // Criação do órgão
            $orgao = Orgao::create([
                'nome' => $data['orgao']['nome'],
                'para_doacao' => $data['orgao']['para_doacao'],
            ]);

            // Associação do usuário com o órgão
            $usuarioOrgao = UsuarioOrgao::create([
                'id_usuario' => $data['usuario']['id'],
                'id_orgao' => $orgao->id,
            ]);

            // Associação do usuário com o hospital
            $hospitalUsuario = HospitalUsuario::create([
                'id_usuario' => $data['usuario']['id'],
                'id_hospital' => $data['hospital']['id'],
            ]);

            DB::commit();

            return [
                'orgao' => $orgao,
                'usuario_orgao' => $usuarioOrgao,
                'hospital_usuario' => $hospitalUsuario,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(int $id, array $data)
    {
        $usuarioOrgao = UsuarioOrgao::findOrFail($id);
        $usuarioOrgao->update($data);
        return $usuarioOrgao;
    }

    public function delete(int $id)
    {
        $usuarioOrgao = UsuarioOrgao::findOrFail($id);
        $usuarioOrgao->delete();
    }

    public  function getByUserId(int $id)
    {
        return UsuarioOrgao::with(['orgao', 'usuario.perfil', 'usuario.endereco'])
            ->where('id_usuario', $id)
            ->get();
    }
}
