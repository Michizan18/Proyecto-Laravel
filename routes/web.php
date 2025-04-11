<?php

// routes/web.php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaBlogController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// Rutas para la página principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas para el e-commerce (productos)
Route::resource('productos', ProductoController::class);
Route::get('productos/categoria/{categoria}', [ProductoController::class, 'filtrarPorCategoria'])->name('productos.categoria');

// Rutas para las categorías de productos
Route::resource('categorias', CategoriaController::class);

// Rutas para el blog (artículos)
Route::resource('articulos', ArticuloController::class);

// Rutas para las categorías del blog
Route::resource('categorias-blog', CategoriaBlogController::class);

// Rutas para los comentarios
Route::resource('comentarios', ComentarioController::class);

// Ruta para cambiar el idioma
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('locale');
