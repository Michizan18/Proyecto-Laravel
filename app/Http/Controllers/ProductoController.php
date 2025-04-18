<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Muestra un listado de productos con filtro opcional por categoría.
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
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('productos.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(ProductoRequest $request)
    {
        if ($request->hasFile('ruta_imagen')) {
            $path = $request->file('ruta_imagen')->store('imgProductos', 'public'); 
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'ruta_imagen' => $path ?? null,
        ]);
       
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Muestra los detalles de un producto específico.
     */
    public function show($id)
    {   
        $producto = Producto::findOrFail($id);

        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto específico en la base de datos.
     */
    public function update(ProductoRequest $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $data = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
        ];
    
        if ($request->hasFile('ruta_imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->ruta_imagen && Storage::disk('public')->exists($producto->ruta_imagen)) {
                Storage::disk('public')->delete($producto->ruta_imagen);
            }
            
            // Guardar la nueva imagen
            $data['ruta_imagen'] = $request->file('ruta_imagen')->store('imgProductos', 'public');
        }
    
        $producto->update($data);
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Elimina un producto específico de la base de datos.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}