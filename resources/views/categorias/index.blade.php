@extends('layouts.app')

@section('titulo', __('Categorías'))

@section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('Categorías') }}</h1>
            <a href="{{ route('categorias.create') }}" class="btn btn-success">
                {{ __('Nueva Categoría') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Nombre') }}</th>
                            <th>{{ __('Descripción') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ Str::limit($categoria->descripcion, 50) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categorias.show', $categoria) }}" class="me-2 btn btn-sm btn-primary">{{ __('Ver') }}</a>
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="me-2 btn btn-sm btn-warning">{{ __('Editar') }}</a>
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('¿Estás seguro de eliminar esta categoría?') }}')">{{ __('Eliminar') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ __('No hay categorías registradas') }}</td>
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
@endsection