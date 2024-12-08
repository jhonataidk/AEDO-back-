<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Endereco;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            [
                'nome' => 'Usuário Administrador',
                'email' => 'usuario1@example.com',
                'password' => 'senha1234',
                'telefone' => '1234567890',
                'id_perfil' => 1,
                'endereco' => [
                    'logradouro' => 'Rua Exemplo 1',
                    'cidade' => 'Cidade 1',
                    'estado' => 'SP',
                    'cep' => '12345678',
                ],
            ],
            [
                'nome' => 'Usuário Doador',
                'email' => 'usuario2@example.com',
                'password' => 'senha1234',
                'telefone' => '0987654321',
                'id_perfil' => 2,
                'endereco' => [
                    'logradouro' => 'Rua Exemplo 2',
                    'cidade' => 'Cidade 2',
                    'estado' => 'RJ',
                    'cep' => '87654321',
                ],
            ],
            [
                'nome' => 'Usuário Receptor',
                'email' => 'usuario3@example.com',
                'password' => 'senha1234',
                'telefone' => '1122334455',
                'id_perfil' => 3,
                'endereco' => [
                    'logradouro' => 'Rua Exemplo 3',
                    'cidade' => 'Cidade 3',
                    'estado' => 'MG',
                    'cep' => '11223344',
                ],
            ],
        ];

        foreach ($usuarios as $data) {

            $endereco = Endereco::create($data['endereco']);
            User::create([
                'nome' => $data['nome'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'telefone' => $data['telefone'],
                'id_perfil' => $data['id_perfil'],
                'id_endereco' => $endereco->id,
            ]);
        }
    }
}
