<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\CategoriaBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 

class ArticuloController extends Controller
{
    /**
     * Muestra un listado de artículos con paginación.
     */
    public function index(Request $request)
    {
        $categoriaId = $request->input('categoria_blog_id');
        
        if ($categoriaId) {
            $articulos = Articulo::where('categoria_blog_id', $categoriaId)->paginate(10);
        } else {
            $articulos = Articulo::paginate(10);
        }
        
        $categorias = CategoriaBlog::all();
        return view('blog.articulos.index', compact('articulos', 'categorias', 'categoriaId'));
    }

    /**
     * Muestra el formulario para crear un nuevo artículo.
     */
    public function create()
    {
        $categorias_blog = CategoriaBlog::all();
        // Asegúrate de que esta ruta coincida con la ubicación real de tu vista
        return view('blog.articulos.create', compact('categorias_blog'));
    }

    /**
     * Almacena un nuevo artículo en la base de datos.
     */
    public function store(Request $request)
    {
        // Agrega esto para depuración
        Log::info('Datos recibidos:', $request->all());
        
        // Verificar si existe el directorio para guardar imágenes
        $directorio = public_path('imagenes/blog');
        if (!file_exists($directorio)) {
            Log::warning('El directorio no existe: ' . $directorio);
            mkdir($directorio, 0755, true);
            Log::info('Directorio creado: ' . $directorio);
        }
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'autor' => 'required|string|max:255',
            'categoria_blog_id' => 'required|exists:categorias_blog,id',
            'imagen_destacada' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $articulo = new Articulo();
        $articulo->titulo = $request->titulo;
        $articulo->contenido = $request->contenido;
        $articulo->autor = $request->autor;
        $articulo->categoria_blog_id = $request->categoria_blog_id;
        $articulo->fecha_publicacion = now();
        
        if ($request->hasFile('imagen_destacada')) {
            $imagen = $request->file('imagen_destacada');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes/blog'), $nombreImagen);
            $articulo->imagen_destacada = 'imagenes/blog/' . $nombreImagen;
        }
        
        $articulo->save();
        
        // Redirección a la ruta correcta según tu archivo de rutas
        return redirect()->route('articulos.index')
            ->with('success', 'Artículo creado exitosamente.');
    }

    /**
     * Muestra los detalles de un artículo específico con sus comentarios.
     */
    public function show(Articulo $articulo)
    {
        $comentarios = $articulo->comentarios()->latest()->paginate(10);
        
        return view('blog.articulos.show', compact('articulo', 'comentarios'));
    }

    /**
     * Muestra el formulario para editar un artículo.
     */
    public function edit(Articulo $articulo)
    {
        $categorias_blog = CategoriaBlog::all();
        return view('blog.articulos.edit', compact('articulo', 'categorias_blog'));
    }

    /**
     * Actualiza un artículo específico en la base de datos.
     */
    public function update(Request $request, Articulo $articulo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'autor' => 'required|string|max:255',
            'categoria_blog_id' => 'required|exists:categorias_blog,id',
            'imagen_destacada' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $articulo->fill($request->except('imagen'));
        
        if ($request->hasFile('imagen_destacada')) {
            $imagen = $request->file('imagen_destacada');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes/blog'), $nombreImagen);
            $articulo->imagen_destacada = 'imagenes/blog/' . $nombreImagen;
        }
        
        $articulo->save();
        
        // Asegúrate de que esta ruta esté definida y sea correcta
        return redirect()->route('articulos.index')
            ->with('success', 'Artículo actualizado exitosamente.');
    }

    /**
     * Elimina un artículo específico de la base de datos.
     */
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
        return redirect()->route('articulos.index')
            ->with('success', 'Artículo eliminado exitosamente.');
    }
}