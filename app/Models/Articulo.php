<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    
    protected $table = 'articulos';
    
    protected $fillable = ['titulo', 'contenido', 'imagen_destacada', 'autor', 'categoria_blog_id', 'fecha_publicacion'];
    
    // Relación con categoría de blog
    public function categoriaBlog()
    {
        return $this->belongsTo(CategoriaBlog::class, 'categoria_blog_id');
    }
    
    // Relación con comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'articulo_id');
    }
}
