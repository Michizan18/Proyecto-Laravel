@extends('layouts.app')

@section('title', __('Create Product'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="mb-0">{{ __('Create New Product') }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="precio" class="form-label">{{ __('Price') }}</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" step="0.01" min="0" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="stock" class="form-label">{{ __('Stock') }}</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
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
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
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
                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                    <div class="form-text">{{ __('Optional. Maximum size: 2MB') }}</div>
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Create Product') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection