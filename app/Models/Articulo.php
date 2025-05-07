<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'imagen_destacada',
        'extracto',
        'autor',
        'fecha_publicacion',
        'slug',
        'categoria_blog_id'
    ];

    // Un artículo pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_blog_id');
    }

    // Un artículo tiene muchos comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}