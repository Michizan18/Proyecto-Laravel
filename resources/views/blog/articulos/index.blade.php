@extends('layouts.app')

@section('titulo', __('Blog'))

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Gestión de Artículos') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('articulos.create') }}" class="btn btn-success">{{ __('Nuevo Artículo') }}</a>
                    </div>

                    <div class="mb-3">
                        <form action="{{ route('articulos.index') }}" method="GET" class="d-flex align-items-center gap-2">
                            <div class="form-group mb-0">
                                <select name="categoria_id" class="form-select">
                                    <option value="">{{ __('Todas las categorías') }}</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-secondary">{{ __('Filtrar') }}</button>
                        </form>
                    </div>                    

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Imagen') }}</th>
                                <th>{{ __('Título') }}</th>
                                <th>{{ __('Categoría') }}</th>
                                <th>{{ __('Autor') }}</th>
                                <th>{{ __('Fecha de Publicación') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articulos as $articulo)
                            <tr>
                                <td>{{ $articulo->id }}</td>
                                <td>
                                    @if($articulo->imagen)
                                        <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="{{ $articulo->titulo }}" width="50">
                                    @else
                                        <span class="badge bg-secondary">Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $articulo->categoria->nombre }}</td>
                                <td>{{ $articulo->autor }}</td>
                                <td>{{ $articulo->fecha_publicacion->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('articulos.show', $articulo) }}" class="btn btn-sm btn-info">{{ __('Ver') }}</a>
                                    <a href="{{ route('articulos.edit', $articulo) }}" class="btn btn-sm btn-warning">{{ __('Editar') }}</a>
                                    <form action="{{ route('articulos.destroy', $articulo) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">{{ __('Eliminar') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $articulos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection