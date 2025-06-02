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
      <a href="/productos">
        <img src="{{ asset('img/search-ico.png') }}" alt="Buscar">
      </a>

      @auth
        <div class="user-menu">
            <!-- Icono de usuario (puede ser una imagen o un ícono dinámico) -->
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

      <a href="#carrito">
        <img src="{{ asset('img/shopping-bag-ico.png') }}" alt="Bolsa">
      </a>
    </div>
  </header>

    @yield('content')
</body>
</html>
