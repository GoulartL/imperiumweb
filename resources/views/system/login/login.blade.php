<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/toastr/css/toastr.css') }}" rel="stylesheet">
    <style>
        .login-form {
            width: 340px;
            margin: 50px auto;
            font-size: 15px;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }
    </style>
</head>

<body class="d-flex align-items-center">
    <div class="login-form ">
        <form method="post" action="{{ route('system.auth') }}">
            @csrf
            <div class="text-center mb-4">
                <img src="{{ asset('assets/images/WEB_IMPERIUM.svg') }}" alt="triangle with all three sides equal"
                    width="200" />
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="E-mail" name="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Senha" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <div class="text-center">
                @if ($errors->any())
                <div class="">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item mt-1 bg-danger text-white">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('danger'))
                <div class="">
                    <ul class="list-group">
                        <li class="list-group-item bg-danger text-white">{{session('danger')}}</li>
                    </ul>
                </div>
                @endif
            </div>
            <div class="text-center mt-3">
                <a href="#">Ainda não é cliente?</a>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/toastr/js/toastr.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>