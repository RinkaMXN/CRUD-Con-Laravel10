<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;


class generos extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $PrimaryKey = 'IdGenero';
    protected $fillable = ['IdGenero','Nombre'];
}
