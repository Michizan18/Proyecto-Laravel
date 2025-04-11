@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
    <div class="mb-4">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            &laquo; {{ __('Back to Products') }}
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">{{ $producto->nombre }}</h1>
                <div>
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded" alt="{{ $producto->nombre }}">
                    @else
                        <div class="bg-light text-center p-5 rounded">
                            <h3>{{ __('No Image Available') }}</h3>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h4>{{ __('Product Details') }}</h4>
                    <hr>
                    
                    <p><strong>{{ __('Category') }}:</strong> {{ $producto->categoria->nombre }}</p>
                    
                    <p><strong>{{ __('Price') }}:</strong> ${{ number_format($producto->precio, 2) }}</p>
                    
                    <p>
                        <strong>{{ __('Stock') }}:</strong> 
                        {{ $producto->stock }}
                        @if($producto->stock < 5)
                            <span class="badge bg-warning">{{ __('Low Stock') }}</span>
                        @endif
                    </p>
                    
                    <div class="mt-4">
                        <h5>{{ __('Description') }}</h5>
                        <p class="lead">{{ $producto->descripcion }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <p><strong>{{ __('Created at') }}:</strong> {{ $producto->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>{{ __('Last update') }}:</strong> {{ $producto->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection