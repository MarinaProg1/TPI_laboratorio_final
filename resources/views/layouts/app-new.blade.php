<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Tienda online UTN</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/images/LogoGris.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="{{ asset('assets/js/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" style="background-color: rgb(0, 1, 1)">
            <div class="sidebar-logo">
                <div class="logo-header" style="background-color: rgb(0, 1, 1)">
                    <img src="{{ asset('assets/images/LogoNegro.png') }}" alt="navbar brand" width="160"
                        height="60" />
                </div>
            </div>
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        @if (auth()->check() && auth()->user()->role == 'admin')
                            <li class="nav-item active">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="fas fa-home" style="color: orange;"></i>
                                    <p>ABM categorias</p>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="fas fa-tag" style="color: orange;"></i>
                                    <p>ABM productos</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="fas fa-list" style="color: orange;"></i>
                                <p>Lista de productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('carts.index') }}" class="nav-link">
                                <i class="fas fa-shopping-cart" style="color: orange;"></i>
                                <p>Carrito</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
                style="background-color: rgb(245, 176, 65)">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="list-group-item">
                            <a href="{{ route('products.index') }}" class="nav-link"><i class="fas fa-tag"></i>
                                Productos</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('carts.index') }}" class="nav-link"><i class="fas fa-shopping-cart"></i>
                                Carrito</a>
                        </li>
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70">
                                    {{ Auth::user()->name }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="ml-3 d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-item topbar-icon dropdown hidden-caret"><i
                                        class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-item topbar-icon dropdown hidden-caret"><i
                                            class="fas fa-user-plus"></i> Registro</a>
                                @endif
                            @endauth
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->

            <div class="container" style="background-color: rgb(245, 247, 230)">
                <div class="page-inner">
                    @yield('content')
                    <!-- Esta es la sección donde se mostrará el contenido específico de cada vista -->
                </div>
            </div>

            <footer class="footer" style="background-color: rgb(245, 176, 65)">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="#">TPI Laboratorio</a></li>
                            <li class="nav-item"><a class="nav-link" href="#"> Tienda online </a></li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by <a
                            href="http://www.themekita.com">Juan Cruz, Federico y Marina</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
