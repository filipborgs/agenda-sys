<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Agenda-Sys | Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script>
        window.onload = function() {
            window.sessionStorage.removeItem('contadorTel');
        }

        function insrirRegistro() {
            cliente = new Cliente();
            cliente.getClienteForm();

            $.ajax({
                type: "POST",
                url: "{{ route('ajax.cadastro.cliente') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(cliente),
                contentType: "application/json",
                error: function(error, er, thrownError) {
                    alert('Erro durante o cadastro');
                    console.log(error);
                    console.log(er);
                    console.log(thrownError);
                },

                success: function(json) {
                    alert("Cadastro realizado com sucesso");
                }
            });
        }

    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="alertModalSys"> </div>

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a href="#" class="nav-link">
                        <h5>Registro</h5>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class=" nav-link">

                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </li>
            </ul>

        </nav>


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <i class="fas fa-address-book"></i>

                <span class="brand-text font-weight-light">Agenda-Sys</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block" id="nomeUser">
                            <i class="far fa-address-card"></i> Administrador
                        </a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('main.agenda') }}" class="nav-link">
                                <i class="fas fa-address-card"></i>

                                <p class="text">Visualizar Agenda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inserir.registro') }}" class="nav-link active">
                                <i class="fas fa-user-plus"></i>
                                <p>Inserir Novo registro</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inserir.usuario') }}" class="nav-link">
                                <i class="fas fa-user-lock"></i>
                                <p>Inserir novo Usuário</p>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul id="menuLateral" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                        role="menu" data-accordion="false">
                    </ul>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>
            <!-- Main content -->
            <section class="content">
                <div id="mainDiv" class="container-fluid">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Insira as informações</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nomeInput">Nome</label>
                                            <input type="text" class="form-control" id="nomeInput"
                                                placeholder="Insira o nome">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" value="F" type="radio"
                                                    name="tipoPessoaRadio">
                                                <label class="form-check-label">Pessoa Física</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="J" type="radio"
                                                    name="tipoPessoaRadio">
                                                <label class="form-check-label">Pessoa Jurídica</label>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="cpfCnpjInput">CPF/CNPJ</label>
                                            <input type="number" input min="0" max="99999999999"  class="form-control" id="cpfCnpjInput"
                                                placeholder="Insira o CPF ou CNPJ">
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Contato</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="emailInput">E-mail</label>
                                            <input type="text" class="form-control" id="emailInput"
                                                placeholder="Insira o E-mail">
                                        </div>

                                        <div id="divTelefone" class="form-group">
                                            <label for="ddd-1">Telefone</label>
                                            <div class="row">

                                                <div class="col-3">
                                                    <input type="number" input min="0" max="99"  id="ddd-1" class="form-control"
                                                        placeholder="DDD">
                                                </div>
                                                <div class="col-9">
                                                    <input  type="number"  input min="0" max="99999999999"  id="telefone-1" class="form-control"
                                                        placeholder="Número">
                                                </div>

                                            </div>
                                        </div>

                                        <div id="divBtnAdd" class="row justify-content-md-center">
                                            <div class="col col-lg-6">
                                                <button type="button" onclick="addRowTelefone();"
                                                    class="btn btn-block btn-info btn-xs">Adicinar outro
                                                    telefone</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Endereço</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="cidadeInput">Cidade</label>
                                            <input type="text" class="form-control" id="cidadeInput"
                                                placeholder="Insira o nome da cidade">
                                        </div>
                                        <div class="form-group">
                                            <label for="ufInput">UF</label>
                                            <input type="text" maxlength="2" class="form-control" id="ufInput"
                                                placeholder="Insira a UF">
                                        </div>
                                        <div class="form-group">
                                            <label for="bairroInput">Bairro</label>
                                            <input type="text" class="form-control" id="bairroInput"
                                                placeholder="Insira o nome do bairro">
                                        </div>
                                        <div class="form-group">
                                            <label for="logadouroInput">Logadouro</label>
                                            <input type="text" class="form-control" id="logadouroInput"
                                                placeholder="Insira o logadouro">
                                        </div>
                                        <div class="form-group">
                                            <label for="numeroInput">Número</label>
                                            <input type="number" input min="0" max="99999999999"  class="form-control" id="numeroInput"
                                                placeholder="Insira o número">
                                        </div>
                                        <div class="form-group">
                                            <label for="complementoInput">Complemento</label>
                                            <input type="text" class="form-control" id="complementoInput"
                                                placeholder="Insira o complemento">
                                        </div>

                                        <div class="form-group">
                                            <label for="cepInput">CEP</label>
                                            <input type="text" class="form-control" id="cepInput"
                                                placeholder="Insira o CEP">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" id="btnCadastrar" onclick="insrirRegistro();"
                                class="btn btn-block btn-info btn-lg">Finalizar Cadastro</button>
                            <br>
                        </div>


                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 - Filipe Borges </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>

</body>

</html>
