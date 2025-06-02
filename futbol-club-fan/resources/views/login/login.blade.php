@extends('layouts.app')

@section('content')
  <div class="form-container">
    <h2>INGRESAR CON CORREO Y CONTRASEÑA</h2>
    <form method="POST" action="/login">
      @csrf
      <!-- Correo -->
      <div class="form-group">
        <label for="email">CORREO</label>
        <input type="email" id="email" name="email" placeholder="tu@ejemplo.com" required>
      </div>

      <!-- Contraseña -->
      <div class="form-group">
        <label for="password">CONTRASEÑA</label>
        <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
      </div>

      <!-- Botón -->
      <button type="submit">INGRESAR</button>
    </form>

    <!-- Enlaces adicionales -->
    <a href="/registro" class="login-link">¿No tienes una cuenta? REGÍSTRATE</a>
    <a href="#" class="login-link bold">OLVIDÉ MI CONTRASEÑA</a>
  </div>

@endsection
