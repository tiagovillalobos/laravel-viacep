<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViaCepAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cep' => $this->zipcode,
            'logradouro' => $this->street,
            'complemento' => $this->complement,
            'bairro' => $this->district,
            'localidade' => $this->city,
            'uf' => $this->state,
        ];
    }
}
