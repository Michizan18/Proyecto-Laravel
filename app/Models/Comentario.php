<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_usuario',
        'email',
        'contenido',
        'articulo_id'
    ];

    // Un comentario pertenece a un artículo
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}