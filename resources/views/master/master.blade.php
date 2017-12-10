<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/dist/css/skins/skin-blue.min.css') }}">

    <style>
        @font-face {
            src: url("{{ asset('fonts/Oxygen/Oxygen-Regular.ttf') }}");
            font-family: Oxygen;
        }

        body {
            font-family: 'Oxygen', sans-serif;
        }

        input:-webkit-autofill, input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 30px white inset;
        }

        .btn-primary:hover {
            border-color: #367fa9;
        }
    </style>

    @yield('css')
</head>
<body class="skin-blue">
    @include('master.includes.header')
    @include('master.includes.sidebar')
    
    <div id="app" class="content-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>