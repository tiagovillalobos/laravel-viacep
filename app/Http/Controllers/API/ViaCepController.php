<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViaCepController extends Controller
{
    public function index(Request $request) 
    {
        $zipcode = $request->zipcode;

        $response = Http::get("https://viacep.com.br/ws/$zipcode/json/")->json();

        return response()->json($response);
        
    }
}
