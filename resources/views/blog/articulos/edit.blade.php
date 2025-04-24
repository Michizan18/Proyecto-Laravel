@extends('layouts.app')

@section('titulo', __('Editar Artículo'))

@section('contenido')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">{{ __('Editar Artículo') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('articulos.update', $articulo) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="titulo" class="form-label">{{ __('Título') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $articulo->titulo) }}" required>
                                    @error('titulo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="categoria_blog_id" class="form-label">{{ __('Categoría') }} <span class="text-danger">*</span></label>
                                    <select name="categoria_blog_id" id="categoria_blog_id" class="form-select @error('categoria_blog_id') is-invalid @enderror" required>
                                        <option value="">{{ __('Seleccionar categoría') }}</option>
                                        @foreach ($categorias_blog as $categoria)
                                            <option value="{{ $categoria->id }}" {{ old('categoria_blog_id', $articulo->categoria_blog_id) == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_blog_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="autor" class="form-label">{{ __('Autor') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="autor" id="autor" class="form-control @error('autor') is-invalid @enderror" value="{{ old('autor', $articulo->autor) }}" required>
                                    @error('autor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">{{ __('Imagen Destacada') }}</label>
                                @if ($articulo->imagen)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="{{ $articulo->titulo }}" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
                                <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
                                <small class="form-text text-muted">{{ __('Dejar en blanco para mantener la imagen actual') }}</small>
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="contenido" class="form-label">{{ __('Contenido') }} <span class="text-danger">*</span></label>
                                <textarea name="contenido" id="contenido" rows="10" class="form-control @error('contenido') is-invalid @enderror" required>{{ old('contenido', $articulo->contenido) }}</textarea>
                                @error('contenido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('articulos.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> {{ __('Actualizar') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection