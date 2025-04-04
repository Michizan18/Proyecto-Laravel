<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto = productos::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

}
