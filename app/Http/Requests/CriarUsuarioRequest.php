<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriarUsuarioRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa solicitação.
     */
    public function authorize(): bool
    {
        return true; // Ajuste conforme necessário.
    }

    /**
     * Regras de validação para a solicitação.
     */
    public function rules(): array
    {
        return [
            // Validação para o usuário
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'telefone' => 'required|string|max:15',
            'id_perfil' => 'required|integer|exists:perfil,id',

            // Validação para o endereço
            'endereco.logradouro' => 'required|string|max:255',
            'endereco.cidade' => 'required|string|max:100',
            'endereco.estado' => 'required|string|max:2',
            'endereco.cep' => 'required|string|size:8',
        ];
    }

    /**
     * Mensagens de erro personalizadas.
     */
    public function messages(): array
    {
        return [
            // Mensagens para o usuário
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Insira um email válido.',
            'email.unique' => 'Esse email já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'As senhas não coincidem.',
            'telefone.required' => 'O telefone é obrigatório.',
            'id_perfil.exists' => 'O perfil selecionado não existe.',

            // Mensagens para o endereço
            'endereco.logradouro.required' => 'O logradouro do endereço é obrigatório.',
            'endereco.cidade.required' => 'A cidade do endereço é obrigatória.',
            'endereco.estado.required' => 'O estado do endereço é obrigatório.',
            'endereco.estado.size' => 'O estado deve ter exatamente 2 caracteres.',
            'endereco.cep.required' => 'O CEP do endereço é obrigatório.',
            'endereco.cep.size' => 'O CEP deve ter exatamente 8 caracteres.',
        ];
    }

    public function getUserData(): array
    {
        return [
            'nome' => $this->input('nome'),
            'email' => $this->input('email'),
            'password' => bcrypt($this->input('password')),
            'telefone' => $this->input('telefone'),
            'id_perfil' => $this->input('id_perfil'),
        ];
    }
}
