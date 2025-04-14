<?php

namespace App\Http\Controllers;

use App\Models\CategoriaBlog;
use Illuminate\Http\Request;

class CategoriaBlogController extends Controller
{
    /**
     * Muestra un listado de categoría de blog
     */
    public function index()
    {
        $categorias = CategoriaBlog::all();
        return view('blog.categorias.index', compact('categorias'));
    }

    /**
     * Muestar el formulario para crear una nueva categoria de blog
     */
    public function create()
    {
        return view('blog.categorias.create');
    }

    /**
     * Almacena una nueva categoría de blog en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:55',
            'descripcion' => 'nullable|string',
        ]);

        CategoriaBlog::create($request->all());
        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría de blog creada exitosamente');
    }

    /**
     * Muestra los detalles de una categoría de blog específica
     */
    public function show(CategoriaBlog $categoriaBlog)
    {
        return view('blog.categoria.show', compact('categoriaBlog'));
    }

    /**
     * Muestra el formulario para editar una categoria de blog
     */
    public function edit(CategoriaBlog $categoriaBlog)
    {
        return view('blog.categorias.edit', compact('categoriaBlog'));
    }

    /**
     * Actualiza una categoria de blog específica en la base de datos
     */
    public function update(Request $request, CategoriaBlog $categoriaBlog)
    {
        $request->validate([
            'nombre' => 'required|string1max:55',
            'descripcion' => 'nullable|string'
        ]);

        $categoriaBlog->update($request->all());
        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría de blog actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaBlog $categoriaBlog)
    {
        $categoriaBlog->delete();
        return redirect()->route('blog.categorias.index')
            ->with('success', 'categoría de blog eliminada exitosamente');
    }
}
