@extends('layouts.app')

@section('titulo', __('Crear Artículo'))

@section('contenido')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('Crear Nuevo Artículo') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('articulos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="titulo" class="form-label">{{ __('Título') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                                    @error('titulo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="categoria_id" class="form-label">{{ __('Categoría') }} <span class="text-danger">*</span></label>
                                    <select name="categoria_id" id="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
                                        <option value="">{{ __('Seleccionar categoria') }}</option>
                                        @foreach ($categorias_blog as $categoria)
                                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : ''}}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="invalid-feedback">{$message}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="autor" class="form-label">{{ __('Autor') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="autor" id="autor" class="form-control @error('autor') is-invalid @enderror" value="{{ old('autor') }}" required>
                                    @error('autor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="imagen" class="form-label">{{ __('Imagen Destacada') }}</label>
                                <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="contenido" class="form-label">{{ __('Contenido') }} <span class="text-danger">*</span></label>
                                <textarea name="contenido" id="contenido" rows="10" class="form-control mb-4 @error('contenido') is-invalid @enderror" required>{{ old('contenido') }}</textarea>
                                @error('contenido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('articulos.index') }}" class="btn btn-secondary">
                                    {{ __('Volver') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Publicar') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Aquí puedes agregar el código para un editor WYSIWYG como CKEditor o TinyMCE
    // Ejemplo con CKEditor:
    // ClassicEditor
    //     .create(document.querySelector('#contenido'))
    //     .catch(error => {
    //         console.error(error);
    //     });
</script>
@endpush