@extends('layouts.app')

@section('titulo', $categoria->nombre)

@section('contenido')
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Detalles de la Categoría') }}</h4>
                    <div>
                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning btn-sm">
                            {{ __('Editar') }}
                        </a>
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('Volver') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ $categoria->nombre }}</h2>
                        <hr>
                        <p class="lead">{{ $categoria->descripcion }}</p>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection