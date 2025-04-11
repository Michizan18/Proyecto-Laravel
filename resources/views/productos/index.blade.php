@extends('layouts.app')

@section('title', __('Products'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ isset($categoria) ? $categoria->nombre . ' - ' . __('Products') : __('Products') }}</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-primary">{{ __('Add New Product') }}</a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">{{ __('Categories') }}</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach(App\Models\Categoria::all() as $cat)
                            <li class="list-group-item">
                                <a href="{{ route('productos.categoria', $cat) }}" class="{{ isset($categoria) && $categoria->id == $cat->id ? 'fw-bold' : '' }}">
                                    {{ $cat->nombre }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="row">
                @forelse($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            @else
                                <div class="bg-light text-center p-5">{{ __('No Image') }}</div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text text-truncate">{{ $producto->descripcion }}</p>
                                <p class="card-text">
                                    <strong>{{ __('Price') }}:</strong> ${{ number_format($producto->precio, 2) }}
                                </p>
                                <p class="card-text">
                                    <strong>{{ __('Stock') }}:</strong> {{ $producto->stock }}
                                    @if($producto->stock < 5)
                                        <span class="badge bg-warning">{{ __('Low Stock') }}</span>
                                    @endif
                                </p>
                                <p class="card-text">
                                    <strong>{{ __('Category') }}:</strong> {{ $producto->categoria->nombre }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                    <div>
                                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">{{ __('No products found') }}</div>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
@endsection