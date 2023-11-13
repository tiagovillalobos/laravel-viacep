<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{ config('app.name') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    @stack('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>

<body>
    
    <div class="container-fluid py-3">

        <div class="row my-3">
            <div class="col text-end">
                <div class="btn-group">
                    <a href="{{ route('addresses.index') }}" class="btn btn-outline-primary">
                        <i class="fa fa-fw fa-list"></i>
                        Lista de Endereços
                    </a>
                    <a href="{{ route('addresses.create') }}" class="btn btn-outline-primary">
                        <i class="fa fa-fw fa-plus-circle"></i>
                        Novo Endereço
                    </a>
                </div>
            </div>
        </div>

        @yield('content')

    </div>
    
    <x-notification.modal-loader />
    <x-notification.modal-error />
    
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    @stack('js')
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>

</html>