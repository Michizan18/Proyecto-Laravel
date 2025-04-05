<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\categorias_productos;

class categorias_productosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        categorias_productos::create([
            'nombre' => 'Ropa',
            'descripcion' => 'Para toda la familia'
        ]);
        categorias_productos::create([
            'nombre' => 'Tecnología',
            'descripcion' => 'Para conectarse al mundo exterior'
        ]);
        categorias_productos::create([
            'nombre' => 'Hogar',
            'descripcion' => 'Para tu comodidad'
        ]);
    }
}
