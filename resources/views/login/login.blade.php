<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/dist/css/AdminLTE.min.css') }}">
    <link href="{{ asset('fonts/Oxygen/Oxygen-Regular.ttf') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/build/toastr.min.css') }}">

    <style>
        @font-face {
            src: url("{{ asset('fonts/Oxygen/Oxygen-Regular.ttf') }}");
            font-family: Oxygen;
        }

        body {
            background: linear-gradient(0deg,rgba(12, 64, 210, 0.41),rgba(21, 18, 76, 0.53)),url("{{ asset('images/login-bg.jpg') }}");
            background-size: cover;
            font-family: 'Oxygen', sans-serif;
        }

        .login-logo a {
            color: white;
        }

        .form-group {
            margin-bottom: 40px;
        }

        input:-webkit-autofill, input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 30px white inset;
        }

        .btn-primary:hover {
            border-color: #367fa9;
        }

    </style>
</head>
<body>

    <div class="login-box">
        <div class="login-logo">
            <a><b>{{ config('app.name') }}</b></a>
        </div>
        
        <div class="login-box-body" id="login">
            <p class="login-box-msg">Informe suas credenciais de acesso</p>
            <login-form base-url="{{url('')}}" redirect-url="{{home()}}"></login-form>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/build/toastr.min.js') }}"></script>

    <script src="{{ asset('js/pages/login/index.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('input').attr('spellcheck', 'false')
        })
    </script>
</body>
</html>