
@extends('layouts.app')

@section('titulo', __('Detalle de Categoría'))

@section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $categoriaBlog->nombre }}</h1>
            <div>
                <a href="{{ route('categoriasBlog.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('Información de la Categoría') }}</h5>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>{{ __('Nombre') }}:</strong> {{ $categoriaBlog->nombre }}</p>
                        <p><strong>{{ __('Descripción') }}:</strong> {{ $categoriaBlog->descripcion }}</p>
                        <p><strong>{{ __('Fecha de Creación') }}:</strong> {{ \Carbon\Carbon::parse($categoriaBlog->created_at)->format('d/m/Y H:i') }}</p>
                        <p><strong>{{ __('Última Actualización') }}:</strong> {{ \Carbon\Carbon::parse($categoriaBlog->updated_at)->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ __('Artículos en esta Categoría') }}</h5>
                
                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Título') }}</th>
                                <th>{{ __('Autor') }}</th>
                                <th>{{ __('Fecha de Publicación') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categoriaBlog->articulos as $articulo)
                                <tr>
                                    <td>{{ $articulo->titulo }}</td>
                                    <td>{{ $articulo->autor }}</td>
                                    <td>{{ \Carbon\Carbon::parse($articulo->fecha_publicacion)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('articulos.show', $articulo) }}" class="btn btn-sm btn-primary">{{ __('Ver') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('No hay artículos en esta categoría') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
