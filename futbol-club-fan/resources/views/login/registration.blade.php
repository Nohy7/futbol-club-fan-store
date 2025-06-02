@extends('layouts.app')

@section('content')
  <div class="form-container">
    <h2>REGISTRO</h2>
    <form method="POST" action="/registration" onsubmit="return validatePassword()">
      @csrf
      <!-- Nombre completo -->
      <div class="form-group">
        <label for="nombre">NOMBRE COMPLETO</label>
        <input type="text" id="nombre" name="name" placeholder="Tu nombre completo" required>
      </div>

      <!-- Dirección -->
      <div class="form-group">
        <label for="direccion">DIRECCIÓN</label>
        <input type="text" id="direccion" name="address" placeholder="Tu dirección" required>
      </div>

      <!-- Correo -->
      <div class="form-group">
        <label for="correo">CORREO</label>
        <input type="email" id="correo" name="email" placeholder="tu@ejemplo.com" required>
      </div>

      <!-- Contraseña -->
      <div class="form-group">
        <label for="contrasena">CONTRASEÑA</label>
        <input type="password" id="contrasena" name="password" placeholder="Mínimo 6 caracteres" required>
      </div>

      <!-- Repetir contraseña -->
      <div class="form-group">
        <label for="repetir_contrasena">REPETIR CONTRASEÑA</label>
        <input type="password" id="repetir_contrasena" name="repeat_password" placeholder="Confirma tu contraseña" required>
      </div>

      <!-- Mensaje de error -->
      <div id="error-message" class="error">Las contraseñas no coinciden</div>

      <!-- Botón -->
      <button type="submit">REGISTRARSE</button>

       <!-- Enlace "Ya tengo cuenta" -->

       <a href="/ingreso" class="login-link">Ya tengo cuenta</a>
    </form>

    <script>
    function validatePassword() {
      const password = document.getElementById("contrasena").value;
      const confirmPassword = document.getElementById("repetir_contrasena").value;
      const errorMessage = document.getElementById("error-message");

      // Limpiar mensaje anterior
      errorMessage.style.display = "none";

      // Validar si los campos no están vacíos y coinciden
      if (password && confirmPassword && password !== confirmPassword) {
        errorMessage.style.display = "block";
        return false; // Evita el envío del formulario
      }

      return true; // Permite el envío si coinciden
    }

    // Validación en tiempo real (opcional)
    document.getElementById("repetir_contrasena").addEventListener("input", function () {
      const password = document.getElementById("contrasena").value;
      const confirmPassword = this.value;
      const errorMessage = document.getElementById("error-message");

      if (password && confirmPassword && password !== confirmPassword) {
        errorMessage.style.display = "block";
      } else {
        errorMessage.style.display = "none";
      }
    });
  </script>
  </div>

@endsection
