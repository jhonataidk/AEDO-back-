<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos.
     */
    protected $fillable = [
        'logradouro',
        'cidade',
        'estado',
        'cep',
    ];

    /**
     * Relacionamento com usuários.
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_endereco', 'id');
    }
}
