<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalUsuario extends Model
{
    use HasFactory;

    protected $table = 'hospitais_usuario';

    protected $fillable = [
        'id_hospital',
        'id_usuario',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_hospital');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
