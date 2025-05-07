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

// Rutas para Productos (E-commerce)
Route::resource('productos', ProductoController::class);
Route::get('productos/categoria/{categoria}', [ProductoController::class, 'porCategoria'])->name('productos.por_categoria');

// Rutas para Categorías de productos
Route::resource('categorias', CategoriaController::class);

// Rutas para Blog
Route::resource('articulos', ArticuloController::class);
Route::get('articulos/categoria/{categoriaBlog}', [ArticuloController::class, 'porCategoria'])->name('articulos.categoria');

// Rutas para Categorías de blog
Route::resource('categoriasBlog', CategoriaBlogController::class);

// Rutas para Comentarios
// Rutas para comentarios
Route::get('/comentarios', [ComentarioController::class, 'index'])->name('blog.comentarios.index');
Route::get('/comentarios/create', [ComentarioController::class, 'create'])->name('blog.comentarios.create');
Route::post('/comentarios', [App\Http\Controllers\ComentarioController::class, 'store'])->name('comentarios.store');
Route::get('/comentarios/{comentario}', [ComentarioController::class, 'show'])->name('blog.comentarios.show');
Route::get('/comentarios/{comentario}/edit', [ComentarioController::class, 'edit'])->name('blog.comentarios.edit');
Route::put('/comentarios/{comentario}', [ComentarioController::class, 'update'])->name('blog.comentarios.update');
Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('blog.comentarios.destroy');

// Rutas para cambio de idioma
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');