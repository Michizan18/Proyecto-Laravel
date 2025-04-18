@extends('layouts.app')

@section('titulo', __('Editar Producto'))

@section('contenido')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('inicio') }}">{{ __('Inicio') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">{{ __('Productos') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Editar') }} {{ $producto->nombre }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        <h1>{{ __('Editar Producto') }}</h1>
    </div>
    <div class="card-body">
        <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="precio" class="form-label">{{ __('Precio') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock" class="form-label">{{ __('Stock') }}</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="categoria_id" class="form-label">{{ __('Categoría') }}</label>
                <select class="form-select @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required>
                    <option value="">{{ __('Selecciona una categoría') }}</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                @if($producto->ruta_imagen)
                    <div class="mb-2">
                        <label class="form-label">{{ __('Imagen Actual') }}</label>
                        <div>
                            <img src="{{ asset('storage/' . $producto->ruta_imagen) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                @endif
                
                <label for="imagen" class="form-label">{{ __('Nueva Imagen') }} ({{ __('opcional') }})</label>
                <input class="form-control @error('imagen') is-invalid @enderror" type="file" id="imagen" name="imagen">
                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('productos.show', $producto) }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection