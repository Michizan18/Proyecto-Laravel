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
        $categorias = CategoriaBlog::paginate(10);
        return view('blog.categoriasBlog.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría de blog.
     */
    public function create()
    {
        return view('blog.categoriasBlog.create');
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
        return redirect()->route('categoriasBlog.index')
            ->with('success', 'Categoría de blog creada exitosamente.');
    }

    /**
     * Muestra los detalles de una categoría de blog específica.
     */
    public function show(String $categoriaBlog)
    {
        $categoriaBlog = CategoriaBlog::findOrFail($categoriaBlog);
        return view('blog.categoriasBlog.show', compact('categoriaBlog'));
    }

    /**
     * Muestra el formulario para editar una categoría de blog.
     */
    public function edit(String $categoriaBlog)
    {
        $categoriaBlog = CategoriaBlog::findOrFail($categoriaBlog);
        return view('blog.categoriasBlog.edit', compact('categoriaBlog'));
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
        return redirect()->route('categoriasBlog.index')
            ->with('success', 'Categoría de blog actualizada exitosamente.');
    }

    /**
     * Elimina una categoría de blog específica de la base de datos.
     */
    public function destroy(String $categoriaBlog)
    {
        $categoriaBlog = CategoriaBlog::findOrFail($categoriaBlog);

        $categoriaBlog->delete();
        return redirect()->route('categoriasBlog.index')
            ->with('success', 'Categoría de blog eliminada exitosamente.');
    }
}