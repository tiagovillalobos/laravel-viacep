<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create() : View
    {
        return view(view: 'addresses.create');
    }
}
