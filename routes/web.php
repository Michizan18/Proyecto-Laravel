<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaBlogController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InicioController;


// Ruta principal
Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Rutas Productos, E-commerce
// Route::resource('productos', ProductoController::class);
Route::get('productos/categoria/{categoria}', [ProductoController::class, 'porCategoria'])->name('productos.categoria');
//muestra todos lso regsitros
Route::get('/ecomerce/productos', [ProductoController::class, 'index'])->name('productos.index');
//muestra el formulario
Route::get('/ecomerce/nuevo-productos', [ProductoController::class, 'create'])->name('productos.create');
//maneja la logica del formulario
Route::post('/ecomerce/nuevo-producto-cargando', [ProductoController::class, 'store'])->name('productos.store');
//muestra un producto
Route::get('/ecomerce/productos/ver-{id}', [ProductoController::class, 'show'])->name('productos.show');
//formulario para editar
Route::get('/ecomerce/productos/editar-{id}', [ProductoController::class, 'edit'])->name('productos.edit');
//logica para actualizar
Route::put('/ecomerce/productos/editar-{id}-cargando', [ProductoController::class, 'update'])->name('productos.update');
//eliminar producto
Route::delete('/ecomerce/producto/-{id}-eliminar', [ProductoController::class, 'destroy'])->name('productos.destroy');


// Rutas categorías de productos
Route::resource('categorias', CategoriaController::class);

// Rutas para blog
Route::resource('articulos', ArticuloController::class);
Route::get('articulos/categoria/{categoriaBlog}', [ArticuloController::class, 'porCategoria'])->name('articulos.categoria');

// Rutas para categorias de blog 
Route::resource('categorias-blog', CategoriaBlogController::class);

//Rutas para comentarios
Route::post('articulos/{articulo}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::put('comentarios/{comentario}', [ComentarioController::class, 'update'])->name('comentarios.update');
Route::delete('comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

// Rutas para cambio de idioma
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');