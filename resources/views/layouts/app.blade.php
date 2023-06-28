<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Gerenciador de Chamados' }}</title>

    <!-- Arquivos CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Arquivos JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">

        <!-- Barra superior -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Botão de alternância do menu lateral -->
            <ul class="navbar-nav">
                <a href="#" class="nav-link px-3" data-widget="pushmenu" role="button"><i
                        class="fas fa-bars"></i></a>
            </ul>
            <!-- Restante da barra superior -->
            <h2>Gerenciador de Chamados</h2>

            <!-- Botão de logout -->
            <ul class="navbar-nav ml-auto logout-button2">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;Sair
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item text-center">
                            <i class="fas fa-power-off" style="color: red;">&nbsp;</i><strong>Logout</strong>
                        </a>
                    </div>
                </li>
            </ul>

        </nav>

        <!-- Menu lateral -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Logo -->
            <a href="index.html" class="brand-link">
                <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"
                    @if (Auth::user()->name > 18) style="font-size: 15px;" @endif> {{ Auth::user()->name }}</span>
            </a>

            <!-- Menu lateral -->
            <div class="sidebar">
                <!-- Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('chamados.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Chamados
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('chamados.going') }}" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>
                                    Chamados em andamento
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('chamados.log') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Chamados concluídos
                                </p>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="{{ route('usuarios.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuários
                                </p>
                            </a>
                        </li>
                        @if (Auth::user()->id == 1)
                        <li class="nav-item">
                            <a href="{{ route('setores.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Setores (Em dev)
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item fixed-bottom logout-button">
                            <a href="#" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-power-off" style="color: red;"></i>
                                <p>{{ __('Logout') }}</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <script src="{{ asset('js/app.js') }}" defer></script>
            </div>
        </aside>

        <!-- Conteúdo da página -->
        <div class="content-wrapper">
            <!-- Conteúdo da página -->
            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <!-- Rodapé -->
        <footer class="main-footer">
            Criado pela Control - STI - 2023
        </footer>
    </div>
</body>

</html>
