<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Agenda-Sys | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <script>
        function auth() {
            let login = document.getElementById('login').value;
            let senha = document.getElementById('senha').value;

            if (login === '' || senha === '') {
                alert('Senha ou login invalido');
            } else {


                $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8000/login",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        nome: "teste12",
                        uf: 'RJ'
                    }),
                    contentType: "application/json",
                    error: function(error, er, thrownError) {
                        alert('erro');
                        console.log(error);
                        console.log(er);
                        console.log(thrownError);
                    },

                    success: function(json) {
                        alert('ss');
                        console.log(json);
                    }
                });
            }
        }

    </script>

    <div class="login-box">

        <div class="login-logo">
            <a href="#"><b>Agenda-</b>Sys</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Insira os dados de login</p>

                <form id="formteste" onSubmit="auth();">
                    <div class="input-group mb-3">
                        <input id="login" type="text" class="form-control" placeholder="Login">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="senha" type="password" class="form-control" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>
