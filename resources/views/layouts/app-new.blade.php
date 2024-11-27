<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Tienda online UTN</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('') }}assets/images/LogoGris.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">

    <!-- Fonts and icons -->
    <script src="{{ asset('') }}assets/js/webfont.min.js"></script>
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
                urls: [{{ asset('assets/css/fonts.min.css') }}],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/css/kaiadmin.min.css" />


</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" style="background-color: rgb(0, 1, 1 )">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" style="background-color: rgb(0, 1, 1 )">

                    <img src="{{ asset('') }}assets/images/LogoNegro.png" alt="navbar brand" width="160"
                        height="60" />

                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
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

                            <a data-bs-toggle="collapse" href="{{ route('products.index') }}">
                                <i class="fas fa-list"style="color: orange;"></i>
                                <p>Lista de productos</p>
                                <span class="caret"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('carts.index') }}" class="nav-link">
                                <i class="fas fa-shopping-cart" styte="color: orange;"></i>
                                <p>Carrito</p>
                                <span class="caret"></span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('') }}assets/images/LogoNegro.png" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
                    style="background-color: rgb(245, 176, 65)">
                    <div class="container-fluid">

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            <li class="list-group-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="fas fa-tag"></i>
                                    Productos
                                </a> <!-- Cierre de la etiqueta <a> agregado aquí -->
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('carts.index') }}" class="nav-link">
                                    <i class="fas fa-shopping-cart"></i>
                                    Carrito
                                </a>
                            </li>


                            <li class="nav-item topbar-user dropdown hidden-caret">
                                @if (Route::has('login'))
                                    <nav class="flex items-center">
                                        @auth
                                            <a href="{{ route('dashboard') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                {{ Auth::user()->name }}
                                            </a>

                                            <!-- Formulario de Cierre de Sesión -->
                                            <form method="POST" action="{{ route('logout') }}" class="ml-3 d-inline">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-link nav-item topbar-icon dropdown hidden-caret"
                                                    style="text-decoration: none;">
                                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="nav-item topbar-icon dropdown hidden-caret">
                                                <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                                            </a> <!-- Cierre de la etiqueta <a> agregado aquí -->
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="nav-item topbar-icon dropdown hidden-caret">
                                                    <i class="fas fa-user-plus"></i> Registro
                                                </a>
                                            @endif
                                        @endauth
                                    </nav>
                                @endif
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container" style="background-color: rgb(245, 247, 230)">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>

            <footer class="footer" style="background-color: rgb(245, 176, 65)">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">

                            <li class="nav-item">
                                <a class="nav-link" href="#">TPI Laboratorio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Tienda online </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">Juan Cruz, Federico y Marina</a>
                    </div>

                </div>
            </footer>

            <!--   Core JS Files   -->
            <script src="{{ asset('') }}assets/js/jquery-3.7.1.min.js"></script>
            <script src="{{ asset('') }}assets/js/popper.min.js"></script>
            <script src="{{ asset('') }}assets/js/bootstrap.min.js"></script>

            <!-- jQuery Scrollbar -->
            <script src="{{ asset('') }}assets/js/jquery.scrollbar.min.js"></script>

            <!-- Chart JS -->
            <script src="{{ asset('') }}assets/js/chart.min.js"></script>

            <!-- jQuery Sparkline -->
            <script src="{{ asset('') }}assets/js/jquery.sparkline.min.js"></script>

            <!-- Chart Circle -->
            <script src="{{ asset('') }}assets/js/circles.min.js"></script>

            <!-- Datatables -->
            <script src="{{ asset('') }}assets/js/datatables.min.js"></script>

            <!-- Bootstrap Notify -->
            <script src="{{ asset('') }}assets/js/bootstrap-notify.min.js"></script>

            <!-- jQuery Vector Maps -->
            <script src="{{ asset('') }}assets/js/jsvectormap.min.js"></script>
            <script src="{{ asset('') }}assets/js/world.js"></script>

            <!-- Sweet Alert -->
            <script src="{{ asset('') }}assets/js/sweetalert.min.js"></script>

            <!-- Kaiadmin JS -->
            <script src="{{ asset('') }}assets/js/kaiadmin.min.js"></script>

</body>

</html>
