@extends('layouts.app')

@section('titulo', __('Categorías'))

@section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('Categorías') }}</h1>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __('Nueva Categoría') }}
            </a>
        </div>
    </div>

    @if(@session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Nombre') }}</th>
                            <th>{{ __('Descripción') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ $categoria->descripcion }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> 
                                        </a>
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
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