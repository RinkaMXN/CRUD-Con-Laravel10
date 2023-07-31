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
        //
        Schema::create('libros',function(Blueprint $table){
            $table->increments('IdLibro');
            $table->integer('IdGenero')->unsigned();
            $table->foreign('IdGenero')->references('IdGenero')->on('generos');
            $table->string('Titulo',100);
            $table->string('Autor',30);
            $table->string('Editorial',30);
            $table->string('Activo',2);
            $table->string('Img',255);
            $table->string('Descripcion',255);

            
            


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('libros');
    }
};
