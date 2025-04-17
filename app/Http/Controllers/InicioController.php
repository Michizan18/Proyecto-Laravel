<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        $productosDestacados = collect([
            new \App\Models\Producto([
                'id'          => 1,
                'nombre'      => 'Producto 1',
                'descripcion' => 'Descripción del producto 1',
                'precio'      => 20.000,
                'stock'       => 10,
                'imagen'      => null,
            ]),
            new \App\Models\Producto([
                'id'          => 2,
                'nombre'      => 'Producto 2',
                'descripcion' => 'Descripción del producto 2',
                'precio'      => 50.000,
                'stock'       => 5,
                'imagen'      => null,
            ]),
            // …
        ]);
        
        
        $articulosRecientes = collect([]);  // Similar para artículos
        
        return view('inicio', compact('productosDestacados', 'articulosRecientes'));
    }
}