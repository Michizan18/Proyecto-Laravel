<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Categorías de productos
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Productos
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('ruta_imagen')->nullable();
            $table->timestamps();
        });

        // Categorías de blog
        Schema::create('categorias_blog', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Artículos del blog
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido');
            $table->string('imagen_destacada')->nullable();
            $table->string('autor');
            $table->foreignId('categoria_blog_id')->constrained('categorias_blog')->onDelete('cascade');
            $table->timestamp('fecha_publicacion')->nullable();
            $table->timestamps();
        });

        // Comentarios
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->string('nombre_usuario');
            $table->string('email');
            $table->foreignId('articulo_id')->constrained('articulos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Orden inverso para respetar las restricciones de clave foránea
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('articulos');
        Schema::dropIfExists('categorias_blog');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('categorias');
    }
}
