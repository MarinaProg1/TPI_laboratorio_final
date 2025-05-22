<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda on line UNT</title>
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <nav class="nav-superior">
        <div class="div-nav ".>
            <img src="{{ asset('') }}assets/images/LogoNegro.png" alt="navbar brand" width="160"
                height="60" />
        </div>
        <div class="div-nav">
            @if (auth()->check() && auth()->user()->role == 'admin')
                <a href="{{ route('products.index') }}" class="this-a">
                    <i class="fas fa-tag" style="color: orange;"></i>
                    ABM productos
                </a>
                <a href="{{ route('products.index') }}" class="this-a">
                    <i class="fas fa-list"style="color: orange;"></i>
                    Lista de productos
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="this-a"><i class="bi bi-people"></i> Sobre nosotros</a>
                <a class="this-a"><i class="bi bi-envelope-at"></i> Contacto</a>
            @endif

            <a href="{{ route('products.index') }}" class="this-a">
                <i class="bi bi-tag"></i> Productos</a>
            <a href="{{ route('carts.index') }}" class="this-a"><i class="bi bi-cart3"></i> Carrito</a>
        </div>
        <div class="div-nav d-flex align-items-center gap-2">
            @if (Route::has('login'))
                @auth
                    <span class="this-a mb-0">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link this-a" style="text-decoration: none">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="this-a">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="this-a">
                            <i class="fas fa-user-plus"></i> Registro
                        </a>
                    @endif
                @endauth
            @endif
        </div>


    </nav>
    <div class="container">
        <div>
            @yield('content')
        </div>
    </div>
    <footer>

        <div> Creado por Marina López</div>
        <div> Para La UTN</div>
        <p>Foto de <a
                href="https://unsplash.com/es/@linusmimietz?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Linus
                Mimietz</a>,<a
                href="https://unsplash.com/es/@wandercreative?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Wander
                Creative</a> y <a
                href="https://unsplash.com/es/@madebyvadim?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Vadim
                Sherbakov</a> en <a
                href="https://unsplash.com/es/fotos/camisa-blanca-de-manga-larga-colgada-en-perchero-de-acero-negro-3E7xsVAQMvc?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
        </p>

    </footer>

    <!--   Core JS Files-->
    <script src="{{ asset('') }}assets/js/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('') }}assets/js/popper.min.js"></script>
    <script src="{{ asset('') }}assets/js/bootstrap.min.js"></script>


</body>

</html>
