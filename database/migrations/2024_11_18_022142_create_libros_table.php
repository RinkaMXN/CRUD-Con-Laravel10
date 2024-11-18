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
        Schema::create('libros', function (Blueprint $table) {
            // Identificador único del libro
            $table->bigIncrements('id_libro');
            // Título del libro
            $table->string('titulo_libro', 50); 
            // Clave foránea para el autor
            $table->unsignedBigInteger('id_autor'); 
            // Relación con la tabla de autores
            $table->foreign('id_autor')->references('id_autor')->on('autores'); 
            // Descripción del libro
            $table->string('descripcion_libro', 256); 
            // Clave foránea para el género
            $table->unsignedBigInteger('id_genero'); 
            // Relación con la tabla de géneros
            $table->foreign('id_genero')->references('id_genero')->on('generos');
            // Fecha de publicación del libro 
            $table->date('fecha_publicacion_libro'); 
            // Foto del libro 
            $table->string('imagen_libro');
            // Campos created_at y updated_at
            $table->timestamps(); 
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
