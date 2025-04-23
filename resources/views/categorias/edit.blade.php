@extends('layouts.app')

@section('titulo', __('Editar Categoría'))

@section('contenido')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">{{ __('Editar Categoría') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">{{ __('Nombre') }} <span class="text-danger">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $categoria->nombre) }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                                <textarea name="descripcion" id="descripcion" rows="4" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                                @error('descripcion')
                                   <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                                    {{ __('Volver') }}
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection