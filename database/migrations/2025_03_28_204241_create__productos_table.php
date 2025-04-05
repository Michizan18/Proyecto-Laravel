<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 255);
            $table->timestamps(); 
        });

        Schema::create('categorias_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 255);
            $table->timestamps(); 
        });

        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 150);
            $table->decimal('precio', 8, 2);
            $table->integer('stock'); 
            $table->foreignId('categoria_id')
                  ->constrained('categorias_productos') 
                  ->onDelete('cascade');
            $table->string('url_imagen');
            $table->timestamps();
        });

        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->string('contenido', 255);
            $table->string('url_imagen');
            $table->string('autor', 50);
            $table->foreignId('categoria_id')
                  ->constrained('categorias_blogs')
                  ->cascadeOnDelete();
            $table->dateTime('fecha_publicacion');
            $table->timestamps();
        });

        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->string('nombre_usuario', 100);
            $table->string('email');
            $table->foreignId('articulo_id')
                  ->constrained('articulos')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('articulos');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('categorias_blogs');
        Schema::dropIfExists('categorias_productos');
    }
};
