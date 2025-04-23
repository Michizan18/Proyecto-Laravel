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
Route::resource('categorias-blog', CategoriaBlogController::class);

// Rutas para Comentarios
Route::post('articulos/{articulo}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::put('comentarios/{comentario}', [ComentarioController::class, 'update'])->name('comentarios.update');
Route::delete('comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

// Rutas para cambio de idioma
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');