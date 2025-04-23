@extends('layouts.app')

@section('titulo', __('Productos por Categoría'))

@section('contenido')
    <div class="container py-4">

            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                {{ __('Volver') }}
            </a>
        <h1>{{ __('Productos de la categoría') }}: {{ $categoria->nombre }}</h1>
        <div class="row">
            @forelse ($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ producto->nombre }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                            <p class="card-text"><strong>${{ $producto->precio }}</strong></p>
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-primary">{{ __('Ver detalles') }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        {{ __('No hay productos en esta categoría') }}
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $productos->links() }}
        </div>
    </div>
@endsection