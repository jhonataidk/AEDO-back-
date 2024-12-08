<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriarOrgaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'para_doacao' => 'required|boolean',
            'id_usuario' => 'required|exists:users,id',
            'id_hospital' => 'required|exists:hospitais,id',
        ];
    }
}
