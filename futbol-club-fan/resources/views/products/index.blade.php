@extends('layouts.app')

@section('content')
    <div class="filter-container">
        @if (request()->has('q'))
            <p>Buscando: <strong>{{ request('q') }}</strong></p>
        @endif

        <!-- Botón para abrir el filtro -->
        <button id="open-filter-btn" class="filter-button">
            FILTRAR
            <img src="{{ asset('img/filtro-ico.png') }}" alt="Filtro">
        </button>
    </div>

    <div class="products">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset('img/catalog/' . $product->url_image) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <p class="price">{{ $product->formatted_price }}</p>
                    <p class="name">{{ $product->name }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{ $products->links('vendor.pagination.paginator') }}

    <!-- Overlay y menú lateral derecho -->
    <div class="overlay" id="filter-overlay"></div>

    <div class="filter-sidebar" id="filter-sidebar">
        <div class="filter-header">
            <h3>FILTRO</h3>
        </div>

        <form id="filter-form" action="/productos" method="GET">
            <input type="hidden" name="q" value="{{ request('q') }}">
            <div class="filter-body">
                <h4>Marcas</h4>
                @php
                    $brands = ['Nike', 'Adidas', 'Puma', 'Reebok'];
                    $selectedBrands = request('brands', []);
                @endphp

                @foreach ($brands as $brand)
                    <label>
                        <input type="checkbox" name="brands[]" value="{{ $brand }}"
                            {{ in_array($brand, $selectedBrands) ? 'checked' : '' }}>
                        {{ $brand }}
                    </label>
                @endforeach

                <h4>Categorías</h4>
                @php
                    $categories = ['Zapatillas', 'Ropa', 'Accesorios'];
                    $selectedCategories = request('categories', []);
                @endphp

                @foreach ($categories as $category)
                    <label>
                        <input type="checkbox" name="categories[]" value="{{ $category }}"
                            {{ in_array($category, $selectedCategories) ? 'checked' : '' }}>
                        {{ $category }}
                    </label>
                @endforeach

                <h4>Precio</h4>
                <div>
                    <label>Desde: $<input class="no-border" type="number" name="min_price" value="{{ request('min_price') }}"
                            min="0"></label>
                    <label>Hasta: $<input class="no-border" type="number" name="max_price" value="{{ request('max_price') }}"
                            min="0"></label>
                </div>
            </div>
            <div class="filter-footer">
            <button class="clear-filter-btn" type="button" onclick="resetFilters()">BORRAR FILTRO</button>
            <button class="apply-filter-btn" type="submit">APLICAR</button>
        </div>
        </form>
    </div>
@endsection
