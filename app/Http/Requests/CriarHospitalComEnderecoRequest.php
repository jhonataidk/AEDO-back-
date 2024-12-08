<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriarHospitalComEnderecoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Validações para o hospital
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:hospitais,email',

            // Validações para o endereço
            'endereco.logradouro' => 'required|string|max:255',
            'endereco.cidade' => 'required|string|max:100',
            'endereco.estado' => 'required|string|max:2',
            'endereco.cep' => 'required|string|size:8',
        ];
    }

    public function messages(): array
    {
        return [
            'endereco.*.required' => 'O campo :attribute do endereço é obrigatório.',
        ];
    }
}
