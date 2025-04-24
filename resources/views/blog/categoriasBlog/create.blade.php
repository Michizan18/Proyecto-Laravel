```blade
@extends('layouts.app')

@section('titulo', __('Crear Categoría de Blog'))

@section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('Crear Categoría de Blog') }}</h1>
            <a href="{{ route('blog.categoriasBlog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('blog.categoriasBlog.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">{{ __('Nombre') }}*</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('Guardar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
```