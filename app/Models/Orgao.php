<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'para_doacao', // Boolean
    ];


    protected function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuarios_orgaos', 'id_orgao', 'id_usuario');
    }

    protected function hospitais()
    {
        return $this->belongsToMany(Hospital::class, 'hospitais_orgaos', 'id_orgao', 'id_hospital');
    }




}
