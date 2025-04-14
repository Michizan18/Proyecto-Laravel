<?php 

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\request;

class CategoriaController extends Controller
{
    /*Listado de categorías*/
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /*Formulario para nueva categoría*/
    public function create()
    {
        return view('categorias.create');
    }

    /*Almacena una nueva gategoría en la base de datos*/
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:55',
            'description' => 'nullable|string',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /*Muestra detalles de una categoría específica*/
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /*Muestra formulario para editar un categoría*/
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /*Actualiza una categoría específica en la base de datos*/
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria->update($request->all());
        return redirect()->rpoute('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /*Elimina una categoría específica de la base de datos*/
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }

}
