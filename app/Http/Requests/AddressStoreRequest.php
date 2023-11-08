<?php

namespace App\Http\Requests;

use App\Rules\Zipcode;
use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
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
            'address.zipcode' => ['required', new Zipcode],
            'address.street' => 'required|string|max:100',
            'address.number' => 'required|string|max:10',
            'address.district' => 'required|string|max:50',
            'address.city' => 'required|string|max:50',
            'address.state' => 'required|string|size:2',
            'address.complement' => 'nullable|string|max:50',
        ];
    }

    public function messages() : array
    {
        return [
            'address.zipcode.required' => 'O campo CEP é obrigatório.',
            'address.street.required' => 'O campo Logradouro é obrigatório.',
            'address.street.string' => 'O campo Logradouro deve ser uma string.',
            'address.street.max' => 'O campo Logradouro deve conter no máximo 100 caracteres.',
            'address.number.required' => 'O campo Número é obrigatório.',
            'address.number.string' => 'O campo Número deve ser uma string.',
            'address.number.max' => 'O campo Número deve conter no máximo 10 caracteres.',
            'address.district.required' => 'O campo Bairro é obrigatório.',
            'address.district.string' => 'O campo Bairro deve ser uma string.',
            'address.district.max' => 'O campo Bairro deve conter no máximo 50 caracteres.',
            'address.city.required' => 'O campo Cidade é obrigatório.',
            'address.city.string' => 'O campo Cidade deve ser uma string.',
            'address.city.max' => 'O campo Cidade deve conter no máximo 50 caracteres.',
            'address.state.required' => 'O campo Estado é obrigatório.',
            'address.state.string' => 'O campo Estado deve ser uma string.',
            'address.state.size' => 'O campo Estado deve conter 2 caracteres.',
            'address.complement.string' => 'O campo Complemento deve ser uma string.',
            'address.complement.max' => 'O campo Complemento deve conter no máximo 50 caracteres.',
        ];
    }
}
