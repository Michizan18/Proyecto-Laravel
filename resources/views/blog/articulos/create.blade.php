@extends('layouts.app')

@section('titulo', 'Crear Artículo')

@section('contenido')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Crear Nuevo Artículo</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('articulos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('articulos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="categoria_blog_id" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select @error('categoria_blog_id') is-invalid @enderror" id="categoria_blog_id" name="categoria_blog_id" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categorias_blog as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_blog_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_blog_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor') }}" required>
                            @error('autor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contenido" class="form-label">Contenido <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="10" required>{{ old('contenido') }}</textarea>
                            @error('contenido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="imagen_destacada" class="form-label">Imagen Destacada</label>
                            <input type="file" class="form-control @error('imagen_destacada') is-invalid @enderror" id="imagen_destacada" name="imagen_destacada">
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                            @error('imagen_destacada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Artículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection