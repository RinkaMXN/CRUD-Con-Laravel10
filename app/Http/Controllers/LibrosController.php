<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libros;
use App\Models\autores;
use App\Models\generos;

class LibrosController extends Controller
{
    //
    public function index(){
        // Obtener todos los libros con los nombres de los autores y géneros
        $libros = libros::select(
            'libros.id_libro',
            'libros.titulo_libro',
            'autores.nombre_autor',
            'libros.descripcion_libro',
            'generos.nombre_genero',
            'libros.fecha_publicacion_libro',
            'libros.imagen_libro'
        )
        ->join('autores', 'libros.id_autor', '=', 'autores.id_autor')
        ->join('generos', 'libros.id_genero', '=', 'generos.id_genero')
        ->get();

        return view ("libros.index")
        ->with("libros", $libros);
    }

    public function create(){
        // Obtener todos los autores
        $autores = autores::select(
            'id_autor',
            'nombre_autor',
        )->get();

        // Obtener todos los géneros
        $generos = generos::select(
            'id_genero',
            'nombre_genero',
        )->get();

        return view ("libros.create")
        ->with("autores", $autores)
        ->with("generos", $generos);
    }
}
