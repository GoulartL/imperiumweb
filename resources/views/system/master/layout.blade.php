<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Elegant admin lite design, Elegant admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Elegant Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>ImperiumWeb</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/elegant-admin-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
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
                {{-- Logo  --}}
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <span>
                            <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <img src="../assets/images/logo-text.png" class="light-logo" alt="homepage" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light"
                                href="javascript:void(0)"><i class="fas fa-bars"></i></a></li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="../assets/images/users/1.jpg" alt="user" class="img-circle" width="30"></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <span><img src="../assets/images/dark-logo-text.png" width="100" alt="elegant admin template"></span>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="fas fa-bars"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="fas fa-bars ti-close"></i></a>
            </div>
            {{-- Sidebar --}}
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="{{ Route('system.home') }}" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Início</span></a></li>
                        <li><a data-toggle="collapse" href="#collapseCrud" role="button" aria-expanded="false" aria-controls="collapseCrud" class="waves-effect waves-dark" href="{{ Route('system.customers') }}" aria-expanded="false"><i class="fa fa-user-plus"></i><span class="hide-menu">Cadastros</span></a>
                            <div class="collapse pl-4" id="collapseCrud">
                                    <a class="waves-effect waves-dark" href="{{ Route('system.customers') }}" aria-expanded="false"><span class="hide-menu">Cliente</span></a>
                                    <a class="waves-effect waves-dark" href="{{ Route('system.suppliers') }}" aria-expanded="false"><span class="hide-menu">Fornecedor</span></a>
                                    <a class="waves-effect waves-dark" href="{{ Route('system.employees') }}" aria-expanded="false"><span class="hide-menu">Funcionário</span></a>
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

    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/sticky-kit/sticky-kit.js') }}"></script>
    <script src="{{ asset('assets/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>