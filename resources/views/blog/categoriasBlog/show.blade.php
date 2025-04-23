@extends('layouts.app')

@section('titulo', __('Detalle de Categoría del Blog'))

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalle de Categoría de Blog') }}</div>

                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('ID') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $categoria->id }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $categoria->nombre }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $categoria->descripcion }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Creación') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $categoria->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Última Actualización') }}:</label>
                        <div class="col-md-6">
                            <p class="form-control-static">{{ $categoria->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('categorias_blog.edit', $categoria) }}" class="btn btn-primary">
                                {{ __('Editar') }}
                            </a>
                            <a href="{{ route('categorias_blog.index') }}" class="btn btn-secondary">
                                {{ __('Volver') }}
                            </a>
                            <form action="{{ route('categorias_blog.destroy', $categoria) }}" method="POST" class="d-inline">
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