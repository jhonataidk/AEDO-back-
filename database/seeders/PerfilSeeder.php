<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfil')->insert([
            ['id' => 1, 'nome' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Doador', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Receptor', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
