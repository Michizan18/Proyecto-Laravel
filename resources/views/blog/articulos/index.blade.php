@extends('layouts.app')

@section('titulo', __('Blog'))

@section('contenido')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Artículos del Blog</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('articulos.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Nuevo Artículo
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filtrar por Categoría</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('articulos.index') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <select name="categoria_blog_id" class="form-select">
                                <option value="">Todas las categorías</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $categoriaId == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
                        </div>
                        @if($categoriaId)
                            <div class="col-md-2">
                                <a href="{{ route('articulos.index') }}" class="btn btn-outline-secondary w-100">
                                    Limpiar
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if($articulos->count() > 0)
            @foreach($articulos as $articulo)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        @if($articulo->imagen_destacada)
                            <img src="{{ asset($articulo->imagen_destacada) }}" class="card-img-top" alt="{{ $articulo->titulo }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <p class="mb-0">Sin imagen</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $articulo->titulo }}</h5>
                            <p class="card-text text-muted">
                                <small>
                                    Por: {{ $articulo->autor }} | 
                                    Categoría: {{ $articulo->categoria_blog_id?->nombre ?? 'Sin categoría' }} |
                                    Publicado: {{ \Carbon\Carbon::parse($articulo->fecha_publicacion)->format('d/m/Y') }}
                                </small>
                            </p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($articulo->contenido, 150) }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('articulos.show', $articulo) }}" class="btn btn-sm btn-primary">
                                Leer más
                            </a>
                            <div>
                                <a href="{{ route('articulos.edit', $articulo) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('articulos.destroy', $articulo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este artículo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    No se encontraron artículos
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $articulos->links() }}
        </div>
    </div>
@endsection