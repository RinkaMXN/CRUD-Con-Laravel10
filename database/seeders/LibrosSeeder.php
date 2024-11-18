<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // crear datos falsos
        $faker = Faker::create();
        // Obtener todos los autores disponibles
        $autores = DB::table('autores')->pluck('id_autor')->toArray();
        // Obtener todos los generos disponibles
        $generos = DB::table('generos')->pluck('id_genero')->toArray();
        // crear 20 registros falsos
        foreach (range(1, 20) as $index) {
            DB::table('libros')->insert([
                // Título con 3 palabras
                'titulo_libro' => $faker->sentence(3),
                // Asignar un autor aleatorio
                'id_autor' => $faker->randomElement($autores),
                // Descripción de hasta 100 caracteres
                'descripcion_libro' => $faker->text(100),
                // Asignar un genero aleatorio
                'id_genero' => $faker->randomElement($generos),
                // Fecha aleatoria
                'fecha_publicacion_libro' => $faker->date(),
                // URL de imagen 
                'imagen_libro' => $faker->imageUrl(200, 300, 'books', true, 'Libro'),
                // Timestamps 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
