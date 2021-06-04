<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Elegant admin lite design, Elegant admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Elegant Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>ImperiumWeb</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    @yield('styles')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/toastr/css/toastr.css') }}" rel="stylesheet">
</head>

<body class="skin-default-dark fixed-layout">
    {{-- Loader que aparece durante o carregamento das páginas --}}
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Carregando</p>
        </div>
    </div>

    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-collapse w-100">
                    <ul class="navbar-nav">
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light"
                                href="javascript:void(0)"><i class="fas fa-bars fa-lg"></i></a></li>
                    </ul>
                    <div class="navbar-header">
                        <a class="navbar-brand ml-0 ml-md-2" href="/">
                            <img src="{{ asset('assets/images/WEB_IMPERIUM.svg') }}" width="100" class="dark-logo" />
                            <img src="{{ asset('assets/images/WEB_IMPERIUM.svg') }}" width="100" class="light-logo" />
                        </a>
                    </div>
                    <ul class="navbar-nav my-lg-0 ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="img-circle"
                                    width="30"></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <img src="{{ asset('assets/images/WEB_IMPERIUM_DARK.svg') }}" width="100" />
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="fas fa-bars"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="fas fa-bars ti-close"></i></a>
            </div>
            {{-- Sidebar --}}
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="{{ Route('system.home') }}"
                                aria-expanded="false"><i class="fa fa-home"></i>
                                <span class="hide-menu">Início</span></a></li>
                        <li><a data-toggle="collapse" href="#collapseCrud" role="button" aria-expanded="false"
                                aria-controls="collapseCrud" class="waves-effect waves-dark" aria-expanded="false"><i
                                    class="fa fa-user-plus"></i><span class="hide-menu">Cadastros</span></a>
                            <div class="collapse pl-4" id="collapseCrud">
                                <a class="waves-effect waves-dark" href="{{ Route('system.customers') }}"
                                    aria-expanded="false"><span class="hide-menu">Cliente</span></a>
                                <a class="waves-effect waves-dark" href="{{ Route('system.suppliers') }}"
                                    aria-expanded="false"><span class="hide-menu">Fornecedor</span></a>
                                <a class="waves-effect waves-dark" href="{{ Route('system.employees') }}"
                                    aria-expanded="false"><span class="hide-menu">Funcionário</span></a>
                            </div>
                        </li>
                        <li><a data-toggle="collapse" href="#collapseFinancial" role="button" aria-expanded="false"
                                aria-controls="collapseFinancial" class="waves-effect waves-dark"
                                aria-expanded="false"><i class="fas fa-hand-holding-usd"></i><span
                                    class="hide-menu">Financeiro</span></a>
                            <div class="collapse pl-4" id="collapseFinancial">
                                <a class="waves-effect waves-dark" href="{{ Route('system.cashFlow') }}"
                                    aria-expanded="false"><span class="hide-menu">Fluxo de caixa</span></a>
                                <a class="waves-effect waves-dark" href="{{ Route('system.payments') }}"
                                    aria-expanded="false"><span class="hide-menu">Pagamentos</span></a>
                                <a class="waves-effect waves-dark" href="{{ Route('system.receipts') }}"
                                    aria-expanded="false"><span class="hide-menu">Recebimentos</span></a>
                            </div>
                        </li>
                        <li><a data-toggle="collapse" href="#collapseProduction" role="button" aria-expanded="false"
                                aria-controls="collapseProduction" class="waves-effect waves-dark"
                                aria-expanded="false"><i class="fas fa-cut"></i><span
                                    class="hide-menu">Produção</span></a>
                            <div class="collapse pl-4" id="collapseProduction">
                                <a class="waves-effect waves-dark" href="{{ Route('system.production.dashboard') }}"
                                    aria-expanded="false"><span class="hide-menu">Dashboard</span></a>
                                <a class="waves-effect waves-dark" href="{{ Route('system.orders') }}"
                                    aria-expanded="false"><span class="hide-menu">Pedidos</span></a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>

    @yield('components')

    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/sticky-kit/sticky-kit.js') }}"></script>
    <script src="{{ asset('assets/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/toastr/js/toastr.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'company': {{ auth()->user()->company }}
            }
        });
    </script>
    @yield('scripts')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>