@extends('layouts.app')

@section('content')
    <div class="rectangle"></div>
    <!-- Rectángulo contenedor -->
    <div class="rectangulo">
        <!-- Triángulos isósceles -->
        <div class="triangulo t1"></div>
        <div class="triangulo t2"></div>
        <div class="triangulo t3"></div>
        <div class="triangulo t4"></div>
        <div class="triangulo t5"></div>
        <div class="triangulo t6"></div>
    </div>

    <div class="banner">
        <span>DONDE LOS VERDADEROS FANS VISTEN SU PASIÓN</span>
        <img src="{{ asset('img/uniform.png') }}" alt="Uniforme" class="uniform">
    </div>

    <div class="footer">
        <div class="social-media">
            <span>SIGUENOS</span>
            <div class="icons">
                <a href="#">
                    <img src="{{ asset('img/facebook.png') }}" alt="Facebook">
                </a>
                <a href="#">
                    <img src="{{ asset('img/instagram.png') }}" alt="Instagram">
                </a>
                <a href="#">
                    <img src="{{ asset('img/x.png') }}" alt="X">
                </a>
            </div>
        </div>
        <div class="text-pattern">
            <!-- Repite el texto para crear el patrón -->
            <span>WE WILL WIN!</span>
            <span>WE WILL WIN!</span>
            <span>WE WILL WIN!</span>
        </div>
    </div>
    <div class="names">
        <p>Jhon Anderson Ramirez Serrato</p>
        <p>Diana Carolina Doria Mora</p>
        <p>Jhoan Sebastian Tellez Perez</p>
        <p>Edwin Alberto Rubiano Carreño</p>
        <p>Jhon Faber Muñoz</p>
    </div>
@endsection
