@extends('layouts.app')

@section('titulo', __('Productos'))

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('Catálogo de Productos') }}</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-success">{{ __('Nuevo Producto') }}</a>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-header">{{ __('Categorías') }}</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('productos.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('productos.index') && !request()->has('categoria') ? 'active' : '' }}">
                    {{ __('Todas') }}
                </a>
                @foreach( $categorias as $categoria)
                    <a href="{{ route('productos.por_categoria', $categoria) }}" class="list-group-item list-group-item-action {{ request()->is('productos/categoria/'.$categoria->id) ? 'active' : '' }}">
                        {{ $categoria->nombre }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        @if($productos->count())
            <div class="row">
                @foreach( $productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if( $producto->ruta_imagen)
                                <img src="{{ asset('storage/imgProductos/' . $producto->ruta_imagen) }}" alt="{{ $producto->nombre }}">
                            @else
                                <img src="{{ asset('imagenes/producto-default.jpg') }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text text-success fw-bold">${{ number_format( $producto->precio, 2) }}</p>
                                <p class="card-text">
                                    <span class="badge {{ $producto->stock > 5 ? 'bg-success' : 'bg-danger' }}">
                                        {{ __('Stock') }}: {{ $producto->stock }}
                                    </span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-primary">{{ __('Ver') }}</a>
                                    <div>
                                        <a href="{{  route('productos.edit', $producto->id)}}" class="btn btn-sm btn-warning">{{ __('Editar') }}</a>
                                        <form action="{{  route('productos.destroy', $producto->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('¿Estás seguro?') }}')">{{ __('Eliminar') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">{{ __('Categoría') }}: {{ $producto->categoria->nombre }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $productos->links() }}
            </div>
        @else
            <div class="alert alert-info">
                {{ __('No hay productos disponibles en esta categoría.') }}
            </div>
        @endif
    </div>
</div>
@endsection