<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class libros extends Model
{
    // Nombre de la tabla
    protected $table = 'libros'; 
    // Clave primaria
    protected $primaryKey = 'id_libro'; 
    // Campos que pueden ser asignados de forma masiva
    protected $fillable = [
        'id_libro',
        'titulo_libro',
        'id_autor',
        'descripcion_libro',
        'id_genero',
        'fecha_publicacion_libro',
        'imagen_libro',
    ];
}
