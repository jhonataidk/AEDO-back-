<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioOrgaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'orgao' => 'required|array', // Dados do órgão
            'orgao.nome' => 'required|string|max:255',
            'orgao.para_doacao' => 'required|boolean',

            'usuario' => 'required|array', // Dados do usuário
            'usuario.id' => 'required|exists:users,id',

            'hospital' => 'required|array', // Dados do hospital
            'hospital.id' => 'required|exists:hospitais,id',
        ];
    }

    public function messages(): array
    {
        return [
            'orgao.nome.required' => 'O nome do órgão é obrigatório.',
            'orgao.para_doacao.required' => 'O status de doação do órgão é obrigatório.',
            'usuario.id.required' => 'O ID do usuário é obrigatório.',
            'usuario.id.exists' => 'O usuário selecionado não existe.',
            'hospital.id.required' => 'O ID do hospital é obrigatório.',
            'hospital.id.exists' => 'O hospital selecionado não existe.',
        ];
    }
}
