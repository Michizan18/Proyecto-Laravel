<?php

namespace App\Http\Controllers;

use App\Models\CategoriaBlog;
use Illuminate\Http\Request;

class CategoriaBlogController extends Controller
{
    /**
     * Muestra un listado de categorías de blog.
     */
    public function index()
    {
        $categorias = CategoriaBlog::all();
        return view('blog.categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría de blog.
     */
    public function create()
    {
        return view('blog.categorias.create');
    }

    /**
     * Almacena una nueva categoría de blog en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        CategoriaBlog::create($request->all());
        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría de blog creada exitosamente.');
    }

    /**
     * Muestra los detalles de una categoría de blog específica.
     */
    public function show(CategoriaBlog $categoriaBlog)
    {
        return view('blog.categorias.show', compact('categoriaBlog'));
    }

    /**
     * Muestra el formulario para editar una categoría de blog.
     */
    public function edit(CategoriaBlog $categoriaBlog)
    {
        return view('blog.categorias.edit', compact('categoriaBlog'));
    }

    /**
     * Actualiza una categoría de blog específica en la base de datos.
     */
    public function update(Request $request, CategoriaBlog $categoriaBlog)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoriaBlog->update($request->all());
        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría de blog actualizada exitosamente.');
    }

    /**
     * Elimina una categoría de blog específica de la base de datos.
     */
    public function destroy(CategoriaBlog $categoriaBlog)
    {
        $categoriaBlog->delete();
        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría de blog eliminada exitosamente.');
    }
}
