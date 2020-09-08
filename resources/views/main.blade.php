<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Agenda-Sys | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script>
        window.onload = function() {
            listar("{{ route('ajax.pesquisa.cliente') }}");
        }

        function pesquisar() {
            let pesquisa = document.getElementById('pesquisaInput').value;

            if (pesquisa === null) {
                pesquisa = "{{ route('ajax.pesquisa.cliente') }}";
            } else {
                pesquisa = "{{ route('ajax.pesquisa.cliente') }}" + "/" + pesquisa;
            }

            listar(pesquisa);
        }

        function listar(url) {
            document.getElementById('divLoading').style.display = "block";
            $("#tbodyAgenda").empty();

            $.ajax({
                type: "GET",
                url: url,
                // url: "{{ route('ajax.pesquisa.cliente') }}" + "/" + pesquisa,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(error, er, thrownError) {
                    alert('Erro');
                    document.getElementById('divLoading').style.display = "none";

                    console.log(error);
                    console.log(er);
                    console.log(thrownError);
                },

                success: function(json) {
                    console.log(json);
                    let tbody = document.getElementById('tbodyAgenda');

                    for (let cliente of json.data) {
                        let tr = document.createElement("tr");
                        tr.setAttribute("onclick", "abrirCliente(" + cliente.id + ");");
                        tr.setAttribute("style", "cursor: pointer");

                        let td = document.createElement("td");
                        td.innerText = cliente.id;
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.innerText = cliente.nome;
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.innerText = cliente.tipoPessoa;
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.innerText = cliente.cpfCnpj;
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.innerText = cliente.email;
                        tr.appendChild(td);

                        td = document.createElement("td");
                        td.innerText = cliente.telefone;
                        tr.appendChild(td);

                        tbody.appendChild(tr);
                    }

                    document.getElementById('divLoading').style.display = "none";

                    let btnAnterior = document.getElementById('btnAnterior');
                    if (json.current_page != 1) {
                        btnAnterior.setAttribute('onclick', 'listar(\'' + json.prev_page_url + '\');');
                        btnAnterior.style.display = "block"
                    } else {
                        btnAnterior.setAttribute('onclick', '');
                        btnAnterior.style.display = "none"
                    }

                    let btnProximo = document.getElementById('btnProximo');
                    if (json.next_page_url != null) {
                        btnProximo.setAttribute('onclick', 'listar(\'' + json.next_page_url + '\');');
                        btnProximo.style.display = "block"
                    } else {
                        btnProximo.setAttribute('onclick', '');
                        btnProximo.style.display = "none"
                    }

                    document.getElementById('btnAnterior')
                }
            });
        }

        function abrirCliente(id) {
            // window.location.href = "{{ route('ajax.cadastro.usuario') }}" + "/" + id;
            window.location.href = "{{ route('index') }}" + "/cliente-registro/" + id;
        }

    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div id="alertModalSys"> </div>

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a href="#" class="nav-link">
                        <h5>Agenda</h5>
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
                            <a href="{{ route('main.agenda') }}" class="nav-link active">
                                <i class="fas fa-address-card"></i>

                                <p class="text">Visualizar Agenda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inserir.registro') }}" class="nav-link">
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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">

                                        <div class="input-group input-group-sm" style="height: auto;">
                                            <input id="pesquisaInput" type="text" name="table_search"
                                                class="form-control float-right"
                                                placeholder="Insira um nome ou telefone para pesquisar">

                                            <div class="input-group-append">
                                                <button onclick="pesquisar()" type="submit" class="btn btn-default"><i
                                                        class="fas fa-search"></i> Pesquisar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Tipo</th>
                                                    <th>Documento</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyAgenda">

                                            </tbody>

                                        </table>
                                        <div id="divLoading" style="display:block;" class="bd-example">
                                            <div class="text-center">
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                        <div class="row">
                            <div class="btn-group">
                                <button id="btnAnterior" type="button" class="btn btn-info">
                                    < Anterior</button>

                                        <button id="btnProximo" type="button" class="btn btn-info">Próximo ></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="cardsDiv" class="row">

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
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    {{-- <script src="{{ asset('js/global.js') }}"></script>
    --}}

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

</body>

</html>
