<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\Mail;

class ProductoController extends Controller
{
    /**
     * Muestra un listado de productos con filtro opcional por categoría
     */
    public function index(Request $request)
    {
        $categoriaId = $request->input('categoria_id');

        if ($categoriaId) {
            $productos = Producto::where('categoria_id', $categoriaId)->paginate(10);
        } else {
            $productos = Producto::paginate(10);
        }

        $categorias = Categoria::all();
        return view('productos.index', compact('productos', 'categorias', 'categoriaId'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:55',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|interger|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto = new Producto($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalname();
            $imagen->move(public_path('imagenes/productos'), $nombreImagen);
            $producto->ruta_imagen = 'imagenes/productos/' . $nombreImagen;
        }

        $producto->save();

        //Verifica si el stock es bajo y enviar correo
        if ($producto->stock < 5) {
            // Aquí se implementaría el envío de correo de stock bajo
            // Mail::to('admin@example.com')->send(new StockBajoMail($producto));
        }

        return redirect()->route('productos.index')
            ->with('succes', 'Producto creado exitosamente');
    }

    /**
     * Muestra los detalles de un producto específico
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto específico en la base de datos
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:55',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|interger|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $stockAnterior = $producto->stock;
        $producto->fill($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes/productos'), $nombreImagen);
            $producto->ruta_imagen = 'imagene/productos/' . $nombreImagen;
        }

        $producto->save();

        if ($producto->stock < 5 && $stockAnterior >= 5) {
            // Aquí se implementaría el envío de correo de stock bajo
            // Mail::to('admin@example.com')->send(new StockBajoMail($producto));
        }

        return redirect() ->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Elimina un producto específico de la base de datos
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->toute('productos.index')
            ->with('success', 'producto eliminado exitosamente');
    }
}
