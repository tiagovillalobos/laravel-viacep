@extends('layouts.app')

@section('content')
    
    <x-card>
        <form action="{{ route('addresses.store') }}" method="POST">

            @csrf

            <div class="row">
                <div class="col-lg-3">
                    <x-form.input label="CEP" name="address[zipcode]" mask="zipcode" ajax="{{ route('api.viacep.index') }}" target="#address-fields" />
                </div>
            </div>

            <fieldset id="address-fields" class="d-none">

                <div class="row">
                    <div class="col-lg-9">
                        <x-form.input label="Logradouro" name="address[street]" readonly />
                    </div>
                    <div class="col-lg-3">
                        <x-form.input label="Número" name="address[number]" />
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-5">
                        <x-form.input label="Bairro" name="address[district]" readonly />
                    </div>
                    <div class="col-lg-4">
                        <x-form.input label="Cidade" name="address[city]" readonly />
                    </div>
                    <div class="col-lg-3">
                        <x-form.input label="Estado" name="address[state]" readonly />
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <x-form.input label="Complemento" name="address[complement]" optional />
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">
                    Registrar Endereço
                </button>

            </fieldset>

        </form>
    </x-card>

@endsection