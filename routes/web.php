<?php

use App\Http\Controllers\AddressController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;


Route::get('/', function () : RedirectResponse {
    return redirect()->route(route: 'addresses.create');
});

Route::get(uri: '/enderecos/cadastrar', action: [AddressController::class, 'create'])->name(name: 'addresses.create');
Route::post(uri: '/enderecos', action: [AddressController::class, 'store'])->name(name: 'addresses.store');
