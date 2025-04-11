@extends('layouts.app')

@section('title', __('Welcome'))

@section('content')
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h1>{{ __('Welcome to E-commerce & Blog') }}</h1>
            <p class="lead">{{ __('A Laravel project with e-commerce and blog functionalities') }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">{{ __('E-commerce Section') }}</h2>
                </div>
                <div class="card-body">
                    <p>{{ __('Explore our products catalog and discover the best options for you.') }}</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-primary">{{ __('Go to Shop') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h2 class="h5 mb-0">{{ __('Blog Section') }}</h2>
                </div>
                <div class="card-body">
                    <p>{{ __('Read the latest articles and stay updated with our content.') }}</p>
                    <a href="{{ route('articulos.index') }}" class="btn btn-success">{{ __('Go to Blog') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="h5 mb-0">{{ __('Featured Products') }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $featuredProducts = App\Models\Producto::inRandomOrder()->take(3)->get();
                        @endphp
                        
                        @forelse($featuredProducts as $producto)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                                    @else
                                        <div class="bg-light text-center p-5">{{ __('No Image') }}</div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                                        <p class="card-text">${{ number_format($producto->precio, 2) }}</p>
                                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-primary">{{ __('View Details') }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">{{ __('No products found') }}</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection