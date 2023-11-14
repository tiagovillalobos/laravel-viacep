<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ViaCepAddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViaCepController extends Controller
{
    public function index(Request $request) 
    {
        $zipcode = $request->zipcode;

        $address = Address::byZipcode($zipcode)->first();

        if ($address) {
            return ViaCepAddressResource::make($address);
        }

        $response = Http::get("https://viacep.com.br/ws/$zipcode/json/")->json();

        if (isset($response['erro']) && $response['erro'] == true) {
            return response()->json([
                'message' => 'CEP não encontrado'
            ], 404);
        }

        return response()->json($response);
        
    }
}
