@extends('layouts.app')

@section('titulo', __('Editar comentario'))

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Comentario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comentarios.update', $comentario) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-3">
                            <label for="contenido" class="col-md-4 col-form-label text-md-right">{{ __('Contenido') }}</label>
                            <div class="col-md-6">
                                <textarea id="contenido" class="form-control @error('contenido') is-invalid @enderror" name="contenido" required>{{ old('contenido', $comentario->contenido) }}</textarea>
                                @error('contenido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="nombre_usuario" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Usuario') }}</label>
                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control @error('nombre_usuario') is-invalid @enderror" name="nombre_usuario" value="{{ old('nombre_usuario', $comentario->nombre_usuario) }}" required>
                                @error('nombre_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $comentario->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="articulo_id" class="col-md-4 col-form-label text-md-right">{{ __('Artículo') }}</label>
                            <div class="col-md-6">
                                <select id="articulo_id" class="form-control @error('articulo_id') is-invalid @enderror" name="articulo_id" required>
                                    <option value="">{{ __('Seleccione un artículo') }}</option>
                                    @foreach($articulos as $articulo)
                                        <option value="{{ $articulo->id }}" {{ old('articulo_id', $comentario->articulo_id) == $articulo->id ? 'selected' : '' }}>{{ $articulo->titulo }}</option>
                                    @endforeach
                                </select>
                                @error('articulo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
                                </button>
                                <a href="{{ route('comentarios.index') }}" class="btn btn-secondary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection