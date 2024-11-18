<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class autores extends Model
{
    // Nombre de la tabla
    protected $table = 'autores'; 
    // Clave primaria
    protected $primaryKey = 'id_autor'; 
    // Campos que pueden ser asignados de forma masiva
    protected $fillable = [
        'id_autor',
        'nombre_autor',
    ];
}
