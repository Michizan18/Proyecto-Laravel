@extends('layouts.app')

@section('title', __('Inicio'))

@section('content')
<div class="container py-5">
    <!-- Sección de bienvenida -->
    <div class="jumbotron text-center bg-light p-5 mb-5 rounded">
        <h1 class="display-4">{{ __('Bienvenido a nuestra tienda') }}</h1>
        <p class="lead">{{ __('Encuentra los mejores productos y lee nuestro blog especializado') }}</p>
        <hr class="my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('productos.index') }}" class="btn btn-primary btn-lg">{{ __('Ver productos') }}</a>
            <a href="{{ route('articulos.index') }}" class="btn btn-outline-primary btn-lg">{{ __('Visitar blog') }}</a>
        </div>
    </div>
    
    <!-- Productos destacados -->
    <section class="mb-5">
        <h2 class="mb-4">{{ __('Productos destacados') }}</h2>
        <div class="row">
            @forelse ($productosDestacados as $producto)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if(isset($producto['imagen']))
                            <img src="{{ asset('storage/' . $producto['imagen']) }}" class="card-img-top" alt="{{ $producto['nombre'] }}">
                        @else
                            <img src="{{ asset('img/producto-placeholder.jpg') }}" class="card-img-top" alt="{{ $producto['nombre'] }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted">{{ __('Precio') }}: ${{ number_format($producto->precio, 2) }}</p>
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-primary">{{ __('Ver detalles') }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">{{ __('No hay productos destacados disponibles') }}</div>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-primary">{{ __('Ver todos los productos') }}</a>
        </div>
    </section>
    
    <!-- Artículos recientes del blog -->
    <section>
        <h2 class="mb-4">{{ __('Últimos artículos del blog') }}</h2>
        <div class="row">
            @forelse ($articulosRecientes as $articulo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($articulo->imagen_destacada)
                            <img src="{{ asset('storage/' . $articulo->imagen_destacada) }}" class="card-img-top" alt="{{ $articulo->titulo }}">
                        @else
                            <img src="{{ asset('img/articulo-placeholder.jpg') }}" class="card-img-top" alt="{{ $articulo->titulo }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $articulo->titulo }}</h5>
                            <p class="card-text">{{ Str::limit($articulo->contenido, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <small class="text-muted">{{ __('Publicado el') }} {{ $articulo->created_at->format('d/m/Y') }}</small>
                            <a href="{{ route('articulos.show', $articulo) }}" class="btn btn-sm btn-link float-end">{{ __('Leer más') }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">{{ __('No hay artículos recientes disponibles') }}</div>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('articulos.index') }}" class="btn btn-outline-primary">{{ __('Ver todos los artículos') }}</a>
        </div>
    </section>
</div>
@endsection