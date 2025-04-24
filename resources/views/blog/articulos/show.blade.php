@extends('layouts.app')

@section('titulo', $articulo->titulo)

@section('contenido')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $articulo->titulo }}</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('articulos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>Autor:</strong> {{ $articulo->autor }} |
                            <strong>Categoría:</strong> {{ $articulo->categoria->nombre }} |
                            <strong>Publicado:</strong> {{ \Carbon\Carbon::parse($articulo->fecha_publicacion)->format('d/m/Y H:i') }}
                        </div>
                        <div>
                            <a href="{{ route('articulos.edit', $articulo) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>

                @if($articulo->imagen)
                    <img src="{{ asset($articulo->imagen) }}" class="card-img-top" alt="{{ $articulo->titulo }}" style="max-height: 400px; object-fit: contain;">
                @endif

                <div class="card-body">
                    <div class="mb-4">
                        {!! nl2br(e($articulo->contenido)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de comentarios -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Comentarios ({{ $comentarios->total() }})</h3>
            <hr>
        </div>
    </div>

    <!-- Formulario para añadir comentario -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Dejar un comentario</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('comentarios.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="articulo_id" value="{{ $articulo->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contenido" class="form-label">Comentario <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="4" required>{{ old('contenido') }}</textarea>
                            @error('contenido')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Publicar comentario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de comentarios -->
    <div class="row">
        <div class="col-md-12">
            @if($comentarios->count() > 0)
                @foreach($comentarios as $comentario)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $comentario->nombre }}</h5>
                                <small class="text-muted">{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <p class="card-text">{{ $comentario->contenido }}</p>
                            <div class="text-end">
                                <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este comentario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center mt-4">
                    {{ $comentarios->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    No hay comentarios para este artículo. ¡Sé el primero en comentar!
                </div>
            @endif
        </div>
    </div>
@endsection