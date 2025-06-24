<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fútbol Club Fan || Tienda de uniformes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
</head>

<body>
    <!-- Header -->
    <header>
        <!-- Logo y nombre de la tienda -->
        <a href="/" class="logo-container">
            <img src="{{ asset('img/logo-positive.png') }}" alt="Logo de la tienda">
            <span class="store-name">FÚTBOL CLUB FAN</span>
        </a>

        <!-- Iconos: buscar, usuario, carrito -->
        <div class="icons">

            <!-- Icono de búsqueda con funcionalidad -->
            <div class="search-container">
                <a href="#" id="search-icon">
                    <img src="{{ asset('img/search-ico.png') }}" alt="Buscar">
                </a>
                <!-- Input oculto inicialmente -->
                <form id="search-form" action="/productos" method="GET">
                    <input type="text" name="q" id="search-input" placeholder="Buscar...">
                </form>
            </div>

            @auth
                <div class="user-menu">
                    <!-- Icono de usuario -->
                    <div class="user-icon">
                        <img src="{{ asset('img/user-login.png') }}" alt="Usuario">
                    </div>

                    <!-- Menú desplegable -->
                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            {{ Auth::user()->name }}
                        </div>
                        <!--<a href="/perfil">Mi cuenta</a>-->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-button">Salir</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/ingreso">
                    <img src="{{ asset('img/user-ico.png') }}" alt="Usuario">
                </a>
            @endauth

            <a href="#carrito" id="cart-icon">
                <img src="{{ asset('img/shopping-bag-ico.png') }}" alt="Bolsa">
                <span id="cart-count" class="cart-badge">0</span>
            </a>
        </div>
    </header>

    <div class="overlay" id="cart-overlay"></div>

    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3>BOLSA DE COMPRAS (<span id="cart-counter">0</span>)</h3>
        </div>

        <div class="cart-items-container" id="cart-items-container">
            <p>No hay productos aún.</p>
        </div>

        <div class="cart-footer">
            <div class="cart-total">
                <p>Total estimado:</p>
                <p>$ <span id="cart-total">0</span></p>
            </div>

            @auth
                <a href="/checkout" class="buy-cart-btn">FINALIZAR COMPRA</a>
            @else
                <a href="/ingreso" class="buy-cart-btn">INICIAR SESIÓN</a>
            @endauth
        </div>
    </div>

    @yield('content')
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
