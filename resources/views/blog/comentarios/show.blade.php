@extends('layouts.app')

@section('titulo', __('Detalle del comentario'))

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalle del Comentario') }}</div>
                
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('ID') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $comentario->id }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Contenido') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $comentario->contenido }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $comentario->nombre_usuario }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Email') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $comentario->email }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Artículo') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $comentario->articulo->titulo }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Creación') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $comentario->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('comentarios.edit', $comentario) }}" class="btn btn-primary">
                                {{ __('Editar') }}
                            </a>
                            <a href="{{ route('comentarios.index') }}" class="btn btn-secondary">
                                {{ __('Volver') }}
                            </a>
                            <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">
                                    {{ __('Eliminar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection