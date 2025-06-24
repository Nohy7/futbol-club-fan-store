@extends('layouts.app')

@section('content')
    <div class="product-detail">
        <!-- Imagen del producto -->
        <div class="product-image">
            <img src="{{ asset('img/catalog/' . $product->url_image) }}" alt="{{ $product->name }}">
        </div>

        <!-- Información del producto -->
        <div class="product-detail-info">
            <div>
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="stock">{{ $product->stock }} Articulos</p>
                <p class="price">{{ $product->formatted_price }}</p>
            </div>


            <!-- Selector de tallas -->
            <h3>TALLAS</h3>
            <div class="size-selector">
                @foreach (['XS', 'S', 'M', 'L', 'XL'] as $size)
                    <label class="size-option">
                        <input type="radio" name="size" value="{{ $size }}">
                        <span class="size-label">{{ $size }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Contador de cantidad y botón de añadir al carrito -->
            <div class="controls">
                <div class="quantity-controls">
                    <div class="quantity-input">
                        <button class="quantity-button" id="decrease-quantity">-</button>
                        <div class="quantity-display" id="quantity-display">1</div>
                        <button class="quantity-button" id="increase-quantity">+</button>
                    </div>
                    <button class="add-to-cart-btn" id="addToCartBtn" disabled onclick="addToCart({
                        id: {{ $product->id }},
                        name: '{{ addslashes($product->name) }}',
                        price: {{ $product->price }},
                        size: document.querySelector('input[name=size]:checked')?.value,
                        quantity: parseInt(document.getElementById('quantity-display').textContent),
                        image: '{{ $product->url_image }}'
                    })">AÑADIR A LA BOLSA
                    </button>
                </div>
            </div>

            <!-- Descripción del producto -->
            <div class="description">
                <h3>SOBRE EL PRODUCTO</h3>
                <p>Categoria: {{ $product->category ?? '' }}</p>
                <p>{{ $product->description ?? 'Este producto no tiene descripción disponible.' }}</p>
                <h3>ACCESORIOS</h3>
                <p>{{ $product->accessory ?? 'Este producto no tiene accesorios.' }}</p>
            </div>
        </div>
    </div>
@endsection
