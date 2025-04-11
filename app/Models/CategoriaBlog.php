<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaBlog extends Model
{
    use HasFactory;
    
    protected $table = 'categorias_blog';
    
    protected $fillable = ['nombre', 'descripcion'];
    
    // Relación con artículos
    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'categoria_blog_id');
    }
}
