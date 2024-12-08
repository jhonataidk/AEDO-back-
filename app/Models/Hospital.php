<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitais';

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'criado_por',
        'id_endereco',
    ];

    /**
     * Relacionamento com Endereco.
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'id_endereco');
    }

    /**
     * Relacionamento com o Usuário que criou o registro.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }
}
