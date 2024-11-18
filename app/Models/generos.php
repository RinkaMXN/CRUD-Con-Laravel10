<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class generos extends Model
{
    // Nombre de la tabla
    protected $table = 'generos'; 
    // Clave primaria
    protected $primaryKey = 'id_genero'; 
    // Campos que pueden ser asignados de forma masiva
    protected $fillable = [
        'id_genero',
        'nombre_genero',
    ];
}
