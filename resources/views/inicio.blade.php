@extends('layouts.app')

@section('titulo', __('Inicio'))

@section('contenido')
<div class="jumbotron bg-light p-5 rounded">
    <h1 class="display-4">{{ __('Bienvenido a nuestra Tienda y Blog') }}</h1>
    <p class="lead">{{ __('Explora nuestros productos y artículos recientes.') }}</p>
    <hr class="my-4">
    <div class="d-flex gap-2">
        <a href="{{ route('productos.index') }}" class="btn btn-primary">{{ __('Ver Productos') }}</a>
        <a href="{{ route('articulos.index') }}" class="btn btn-secondary">{{ __('Leer Blog') }}</a>
    </div>
</div>

<div class="row mt-5">
    <div class="col md-6">
        <h2>{{ __('Productos Destacados') }}</h2>
        <div class="row">
            @foreach ($productosDestacados as $producto)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        @else 
                            <img src="{{ asset('img/producto-default.jpg') }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text text-success fw-bold">${{ number_format($producto->precio, 2) }}</p>
                            <a href="" class="btn btn-sm btn-outline-primary">{{ __('Ver detalles') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        <h2>{{ __('Últimos Artículos') }}</h2>
        @foreach ($articulosRecientes as $articulo)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ($articulo->imagen)
                            <img src="{{ asset('storage/' . $articulo->imagen) }}" class="img-fluid rounded-start" alt="{{ $articulo->titulo }}">
                        @else
                            <img src="{{ asset('img/articulo-default.jpg') }}" class="img-fluid rounded-start" alt="{{ $articulo->titulo }}">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $articulo->titulo }}</h5>
                            <p class="card-text">{{ Str::limit($articulo->contenido, 100) }}</p>
                            <p class="card-text"><small class="text-muted">{{ $articulo->created_at->format('d/m/Y') }}</small></p>
                            <a href="{{ route('articulos.show', $articulo) }}" class="btn btn-sm btn-outline-secondary">{{ __('Leer más') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>