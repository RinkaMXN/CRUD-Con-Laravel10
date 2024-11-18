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
        Schema::create('generos', function (Blueprint $table) {
            // Identificador único del genero
            $table->bigIncrements('id_genero');
            // Nombre del genero
            $table->string('nombre_genero', 50); 
            // Campos created_at y updated_at
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generos');
    }
};
