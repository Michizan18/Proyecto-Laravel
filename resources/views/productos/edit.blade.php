@extends('layouts.app')

@section('title', __('Edit Product'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0">{{ __('Edit Product') }}: {{ $producto->nombre }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="precio" class="form-label">{{ __('Price') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" step="0.01" min="0" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="stock" class="form-label">{{ __('Stock') }}</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" min="0" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">{{ __('Category') }}</label>
                    <select class="form-select @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required>
                        <option value="">{{ __('Select a category') }}</option>
                        @foreach(App\Models\Categoria::all() as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="imagen" class="form-label">{{ __('Image') }}</label>
                    
                    @if($producto->imagen)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    
                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                    <div class="form-text">{{ __('Leave empty to keep current image') }}</div>
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('productos.show', $producto) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Update Product') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection