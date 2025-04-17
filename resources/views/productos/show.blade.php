@extends('layouts.app')

@section('titulo', 'Detalle de Producto')

@section('contenido')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre }}</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="row g-0">
            @if ($producto->ruta_imagen)
                <img src="{{ asset($producto->ruta_imagen) }}" class="img-fluid rounded-start" alt="{{ $producto->nombre }}">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center">
                    <span class="text-muted">Sin imagen</span>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h1 class="card-title">{{ $producto->nombre }}</h1>
                <h4 class="text-success mb-3">${{ number_format($producto->precio, 2) }}</h4>

                <p class="card-text">{{ $producto->descripcion }}</p>

                <div class="mb-3">
                    <span class="badge {{ $producto->stock > 5 ? 'bg-success' : 'bg-danger' }}">
                        Stock: {{ $producto->stock }}
                    </span>
                    <div class="badge bg-info">
                        Categoría: {{ $producto->categoria->nombre }}
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($productosRelacionados->count() > 0)
        <h3>Productos Relacionados</h3>
        <div class="row">
            @foreach ($productosRelacionados as $productoRelacionado)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if ($productoRelacionado->ruta_imagen)
                            <img src="{{ asset($productoRelacionado->ruta_imagen) }}" class="card-img-top" alt="{{ $productoRelacionado->nombre }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <span class="text-muted">Sin imagen</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $productoRelacionado->nombre }}</h5>
                            <p class="card-text">${{ number_format($productoRelacionado->precio, 2) }}</p>
                            <a href="{{ route('productos.show', $productoRelacionado) }}" class="btn btn-sm btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection