@extends('layouts.app')

@section('titulo', __('Comentarios'))

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Gestión de Comentarios') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('comentarios.create') }}" class="btn btn-success">{{ __('Nuevo Comentario') }}</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Contenido') }}</th>
                                <th>{{ __('Usuario') }}</th>
                                <th>{{ __('Artículo') }}</th>
                                <th>{{ __('Fecha') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comentarios as $comentario)
                            <tr>
                                <td>{{ Str::limit($comentario->contenido, 50) }}</td>
                                <td>{{ $comentario->nombre_usuario }}</td>
                                <td>{{ $comentario->articulo->titulo }}</td>
                                <td>{{ $comentario->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('comentarios.show', $comentario) }}" class="btn btn-sm btn-info">{{ __('Ver') }}</a>
                                    <a href="{{ route('comentarios.edit', $comentario) }}" class="btn btn-sm btn-warning">{{ __('Editar') }}</a>
                                    <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">{{ __('Eliminar') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $comentarios->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection