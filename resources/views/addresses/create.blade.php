@extends('layouts.app')

@section('content')
    
    <div class="card">
        <div class="card-body">
            <form action="">

                <div class="row">
                    <div class="col-lg-3">

                        <x-form.input label="CEP" name="address[zipcode]" mask="zipcode" ajax="{{ route('api.viacep.index') }}" />

                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection