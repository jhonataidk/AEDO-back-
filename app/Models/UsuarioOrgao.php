<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioOrgao extends Model
{
    use HasFactory;

    protected $table = 'usuario_orgao';

    protected $fillable = [
        'id_usuario',
        'id_orgao',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function orgao()
    {
        return $this->belongsTo(Orgao::class, 'id_orgao');
    }
    public function perfil()
    {
        return $this->hasOneThrough(
            Perfil::class, // Modelo de destino
            User::class,   // Modelo intermediário
            'id',          // Chave primária do modelo intermediário
            'id',          // Chave primária do modelo de destino
            'id_usuario',  // Chave estrangeira no modelo atual
            'id_perfil'    // Chave estrangeira no modelo intermediário
        );
    }
}
