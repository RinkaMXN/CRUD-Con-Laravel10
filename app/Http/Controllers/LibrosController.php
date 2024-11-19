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

    public function agregar(){
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


        $consulta = libros::orderBy('id_libro','DESC')
            ->take(1)
            ->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else
        {
            $idsigue = $consulta[0]->id_libro + 1;
        }

        return view ("libros.create")
        ->with("idsigue", $idsigue)
        ->with("autores", $autores)
        ->with("generos", $generos);
    }

    public function create(Request $request){
         // VALIDAMOS QUE LOS DATOS ESTÁN LLEGANDO AL CONTROLADOR
         
         $this->validate($request,[
            'create_id_libro' => ['required'],
            'create_titulo_libro' => ['required','max:50','regex:/^[a-zA-Z\s\-,]+$/'],
            'create_autor_libro' => ['required'],
            'create_genero_libro' => ['required'],
            'create_fecha_publicacion_libro' => ['required','date'], 
            'create_descripcion_libro' => ['required'],
            'create_imagen_libro' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
        ],
        [
            'create_id_libro.required' => 'El ID del libro es obligatorio.',
            'create_titulo_libro.required' => 'El título del libro es obligatorio.',
            'create_titulo_libro.max' => 'El título del libro no debe exceder los 50 caracteres.',
            'create_titulo_libro.regex' => 'El título del libro solo puede contener letras, espacios, guiones y comas.',
            'create_autor_libro.required' => 'El autor del libro es obligatorio.',
            'create_genero_libro.required' => 'El género del libro es obligatorio.',
            'create_fecha_publicacion_libro.required' => 'La fecha de publicación es obligatoria.',
            'create_fecha_publicacion_libro.date' => 'La fecha de publicación debe ser una fecha válida.',
            'create_descripcion_libro.required' => 'La descripción es obligatoria.',
            'create_imagen_libro.required' => 'La imagen del libro es obligatoria.',
            'create_imagen_libro.image' => 'El archivo debe ser una imagen válida.',
            'create_imagen_libro.mimes' => 'La imagen debe estar en formato jpeg, png, jpg o gif.',
        ]);

        
        $file = $request->file('create_imagen_libro');
        $img = $file->getClientOriginalName();
        $img2 = $request->create_id_libro . $img;
        \Storage::disk('local')->put($img2, \File::get($file));
        // GUARDAR LOS DATOS EN LA BASE DE DATOS

        
        $libro = new Libros();
        $libro->id_libro = $request->create_id_libro;
        $libro->titulo_libro = $request->create_titulo_libro;
        $libro->id_autor = $request->create_autor_libro;
        $libro->id_genero = $request->create_genero_libro;
        $libro->fecha_publicacion_libro = $request->create_fecha_publicacion_libro;
        $libro->descripcion_libro = $request->create_descripcion_libro;
        $libro->imagen_libro = $img2;
        $libro->save();

        return redirect()->back()->with('success', 'Libro guardado');
    }
}
