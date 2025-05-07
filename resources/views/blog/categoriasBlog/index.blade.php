@extends('layouts.app')

@section('titulo', __('Categorías del Blog'))

@section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('Categorías del Blog') }}</h1>
            <a href="{{ route('categoriasBlog.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> {{ __('Nueva Categoría') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Descripción') }}</th>
                                <th>{{ __('Artículos') }}</th>
                                <th>{{ __('Fecha de Creación') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ Str::limit($categoria->descripcion, 50) }}</td>
                                    <td>{{ $categoria->articulos->count() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('categoriasBlog.show', $categoria) }}" class="me-2 btn btn-sm btn-primary">{{ __('Ver') }}</a>
                                            <a href="{{ route('categoriasBlog.edit', $categoria) }}" class="me-2 btn btn-sm btn-warning">{{ __('Editar') }}</a>
                                            <form action="{{ route('categoriasBlog.destroy', $categoria) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('¿Estás seguro de eliminar esta categoría?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="me-2 btn btn-sm btn-danger">{{ __('Eliminar')}}</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">{{ __('No hay categorías registradas') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $categorias->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection