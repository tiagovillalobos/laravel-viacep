<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use App\Models\Address;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function index() : View
    {
        return view(view: 'addresses.index', data: [
            'addresses' => Address::paginate(),
        ]);
    }

    public function create() : View
    {
        return view(view: 'addresses.create');
    }

    public function store(AddressStoreRequest $request) : JsonResponse
    {
        Address::create($request->address);

        return response()->json([
            'redirect' => route('addresses.index'),
            'toast' => [
                'type' => 'success',
                'message' => 'Endereço Cadastrado com Sucesso!',
            ]
        ]);
    }
}
