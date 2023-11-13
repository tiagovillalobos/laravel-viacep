@extends('layouts.app')

@section('content')

    <x-card>
        <table class="table">
            <thead>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Complemento</th>
            </thead>
            <tbody>
                @foreach ($addresses as $address)
                    <tr>
                        <td>{{ $address->zipcode }}</td>
                        <td>{{ $address->street }}</td>
                        <td>{{ $address->number }}</td>
                        <td>{{ $address->district }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->state }}</td>
                        <td>{{ $address->complement }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-3">
            {{ $addresses->links() }}
        </div>

    </x-card>

@endsection