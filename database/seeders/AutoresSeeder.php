<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AutoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // crear datos falsos
        $faker = Faker::create();

        // crear 20 registros falsos
        foreach (range(1, 20) as $index) {
            DB::table('autores')->insert([
                // Nombre ficticio
                'nombre_autor' => $faker->firstName(),
                // Timestamps 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
