<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // Crea objetos Producto manualmente si es necesario para pruebas
        $productosDestacados = collect([
            new \App\Models\Producto([
                'nombre' => 'Producto 1',
                'descripcion' => 'Descripción del producto 1',
                'precio' => 19.99,
                'stock' => 10,
                'imagen' => null
            ]),
            // Agrega más productos si es necesario...
        ]);
        
        $articulosRecientes = collect([]);  // Similar para artículos
        
        return view('inicio', compact('productosDestacados', 'articulosRecientes'));
    }
}