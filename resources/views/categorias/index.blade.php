@extends('layouts.app')

@section('title', __('Categories'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('Product Categories') }}</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">{{ __('Add New Category') }}</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Products') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ Str::limit($categoria->descripcion, 100) }}</td>
                                <td>{{ $categoria->productos->count() }}</td>
                                <td>{{ $categoria->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('productos.categoria', $categoria) }}" class="btn btn-sm btn-info">
                                            {{ __('View Products') }}
                                        </a>
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure? This will NOT delete associated products.') }}')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('No categories found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $categorias->links() }}
    </div>
@endsection