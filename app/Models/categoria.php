<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion' ];

    public function productos()
    {
        return $this->hasMany(productos::class);
    }
}
