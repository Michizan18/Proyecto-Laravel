<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComentarioController extends Controller
{
    /**
     * Muestra un listado de comentarios
     */
    public function index(Request $request)
    {
        $articulo_id = $request->input('articulo_id');
        
        if ($articulo_id) {
            $comentarios = Comentario::where('articulo_id', $articulo_id)->paginate(15);
            $articulo = Articulo::findOrFail($articulo_id);
            return view('blog.comentarios.index', compact('comentarios', 'articulo'));
        } else {
            $comentarios = Comentario::paginate(15);
            return view('blog.comentarios.index', compact('comentarios'));
        }
    }
    
    /**
     * Muestra el formulario para crear un nuevo comentario
     */
    public function create(Request $request)
    {
        $articulo_id = $request->input('articulo_id');
        $articulo = Articulo::findOrFail($articulo_id);
        
        return view('blog.comentarios.create', compact('articulo'));
    }
    
    /**
     * Almacena un nuevo comentario para un artículo específico
     */
    public function store(Request $request)
    {
        $request->validate([
            'articulo_id' => 'required|exists:articulos,id',
            'contenido' => 'required|string',
            'nombre_usuario' => 'required|string|max:55',
            'email' => 'required|email|max:55'
        ]);
        
        $comentario = new Comentario($request->all());
        $comentario->save();
        
        $articulo = Articulo::findOrFail($request->articulo_id);
        
        return redirect()->route('blog.articulos.show', $articulo)
            ->with('success', 'Comentario agregado exitosamente');
    }
    
    /**
     * Muestra los detalles de un comentario especifíco
     */
    public function show(Comentario $comentario)
    {
        return view('blog.comentarios.show', compact('comentario'));
    }
    
    /**
     * Muestra el formulario para editar un comentario
     */
    public function edit(Comentario $comentario)
    {
        return view('blog.comentarios.edit', compact('comentario'));
    }
    
    /**
     * Actualiza un comentario específico en la base de datos
     */
    public function update(Request $request, Comentario $comentario)
    {
        $request->validate([
            'contenido' => 'required|string',
            'nombre_usuario' => 'required|string|max:55',
            'email' => 'required|email|max:55',
        ]);
        
        $comentario->update($request->all());
        
        return redirect()->route('blog.articulos.show', $comentario->articulo)
            ->with('success', 'Comentario actualizado exitosamente');
    }
    
    /**
     * Elimina un comentario específico de la base de datos
     */
    public function destroy(Comentario $comentario)
    {
        $articulo = $comentario->articulo;
        $comentario->delete();
        
        return redirect()->route('blog.articulos.show', $articulo)
            ->with('success', 'Comentario eliminado con éxito');
    }
}