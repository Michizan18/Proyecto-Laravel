<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\productos;

class productosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        productos::create([
            'nombre' => 'Camisa',
            'descripcion' => 'Camisa a cuadros talla m',
            'precio' => 50000,
            'stock' => 20,
            'categoria_id' => 1
        ]);

        productos::create([
            'nombre' => 'Laptop',
            'descripcion' => 'Portátil negro hp',
            'precio' => 2300000,
            'categoria_id' => 2
        ]);
    }
}
