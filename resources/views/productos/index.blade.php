@foreach ($productos as $producto)
    <h2>{{ $producto->nombre }}</h2>
    <p>{{ $producto->descripcion }}</p>
    <p>Precio: ${{ $producto->precio }}</p>
    <a href="{{ route('productos.show', $producto->id) }}">Ver más</a>
@endforeach