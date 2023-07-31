<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class libros extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $primaryKey = 'IdLibro';
    protected $fillable = ['IdLibro','IdGenero','Titulo','Autor','Editorial','Activo','Img','Descripcion'];
}
