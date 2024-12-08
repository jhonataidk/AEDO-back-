<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens; // Import necessário para Passport
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefone',

        'id_endereco',
        'id_perfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define the relationship with the Endereco model.
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'id_endereco');
    }

    /**
     * Define the relationship with the Perfil model.
     */
    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil', 'id');
    }


}
