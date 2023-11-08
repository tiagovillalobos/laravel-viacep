<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use App\Models\Address;
use Illuminate\Contracts\View\View;

class AddressController extends Controller
{
    public function create() : View
    {
        return view(view: 'addresses.create');
    }

    public function store(AddressStoreRequest $request)
    {
        Address::create($request->address);

        return response()->json([
            'redirect' => route('addresses.create'),
        ]);
    }
}
