@extends('layouts.app')

@section('title', $articulo->titulo)

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="mb-3">{{ $articulo->titulo }}</h1>
                        
                        <div class="d-flex justify-content-between text-muted mb-4">
                            <div>
                                <i class="fas fa-user"></i> {{ $articulo->autor }}
                            </div>
                            <div>
                                <i class="fas fa-calendar"></i> {{ $articulo->fecha_publicacion->format('d/m/Y') }}
                            </div>
                            <div>
                                <i class="fas fa-folder"></i> {{ $articulo->categoria->nombre }}
                            </div>
                        </div>
                        
                        @if($articulo->imagen)
                            <div class="mb-4 text-center">
                                <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="{{ $articulo->titulo }}" class="img-fluid rounded">
                            </div>
                        @endif
                        
                        <div class="article-content">
                            {!! nl2br(e($articulo->contenido)) !!}
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('articulos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('Volver al Blog') }}
                            </a>
                            
                            <div>
                                <a href="{{ route('articulos.edit', $articulo) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('Editar') }}
                                </a>
                                <form action="{{ route('articulos.destroy', $