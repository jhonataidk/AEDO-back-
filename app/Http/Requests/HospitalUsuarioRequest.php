<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_hospital' => 'required|exists:hospitais,id',
            'id_usuario' => 'required|exists:users,id',
        ];
    }
}
