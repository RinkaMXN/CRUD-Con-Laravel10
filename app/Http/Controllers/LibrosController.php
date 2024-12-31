<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libros;
use App\Models\autores;
use App\Models\generos;

class LibrosController extends Controller
{
    //
    public function welcome(){
        return view ("plantilla.welcome");

    }

    public function index(){
        try { 
            // Obtener todos los libros con los nombres de los autores y géneros
            $libros = libros::select(
                'libros.id_libro',
                'libros.titulo_libro',
                'autores.nombre_autor',
                'autores.id_autor',
                'libros.descripcion_libro',
                'generos.nombre_genero',
                'generos.id_genero',
                'libros.fecha_publicacion_libro',
                'libros.imagen_libro'
            )
            ->join('autores', 'libros.id_autor', '=', 'autores.id_autor')
            ->join('generos', 'libros.id_genero', '=', 'generos.id_genero')
            ->get();

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

            return view ("libros.index")
            ->with("libros", $libros)
            ->with("autores", $autores)
            ->with("generos", $generos)
            ->with("idsigue", $idsigue);
        } catch (\Exception $e) {
            return redirect()->route('welcome')->with('error', 'Hubo un error: ' . $e->getMessage());
        }
        
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

        try {  
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

            return back()->with('success', 'Libro guardado');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el libro: ' . $e->getMessage());
        }
    }

    public function update(Request $request){
         // VALIDAMOS QUE LOS DATOS ESTÁN LLEGANDO AL CONTROLADOR
    
         $this->validate($request,[
            'update_id_libro' => ['required'],
            'update_titulo_libro' => ['required','max:50','regex:/^[a-zA-Z\s\-,]+$/'],
            'update_autor_libro' => ['required'],
            'update_genero_libro' => ['required'],
            'update_fecha_publicacion_libro' => ['required','date'], 
            'update_descripcion_libro' => ['required'],
            'update_imagen_libro' => ['image', 'mimes:jpeg,png,jpg,gif'],
        ],
        [
            'update_id_libro.required' => 'El ID del libro es obligatorio.',
            'update_titulo_libro.required' => 'El título del libro es obligatorio.',
            'update_titulo_libro.max' => 'El título del libro no debe exceder los 50 caracteres.',
            'update_titulo_libro.regex' => 'El título del libro solo puede contener letras, espacios, guiones y comas.',
            'update_autor_libro.required' => 'El autor del libro es obligatorio.',
            'update_genero_libro.required' => 'El género del libro es obligatorio.',
            'update_fecha_publicacion_libro.required' => 'La fecha de publicación es obligatoria.',
            'update_fecha_publicacion_libro.date' => 'La fecha de publicación debe ser una fecha válida.',
            'update_descripcion_libro.required' => 'La descripción es obligatoria.',
            'update_imagen_libro.required' => 'La imagen del libro es obligatoria.',
            'update_imagen_libro.image' => 'El archivo debe ser una imagen válida.',
            'update_imagen_libro.mimes' => 'La imagen debe estar en formato jpeg, png, jpg o gif.',
        ]);


        try {          
            $libro = Libros::findOrFail($request->update_id_libro);
            $libro->titulo_libro = $request->update_titulo_libro;
            $libro->id_autor = $request->update_autor_libro;
            $libro->id_genero = $request->update_genero_libro;
            $libro->fecha_publicacion_libro = $request->update_fecha_publicacion_libro;
            $libro->descripcion_libro = $request->update_descripcion_libro;
            // Subir archivo de evidencia, si existe
            if ($request->hasFile('update_imagen_libro')) {
                // Opcional: eliminar evidencia asociada, si existe
                if ($libro->imagen_libro && file_exists(public_path('archivos/' . $libro->imagen_libro))) {
                    unlink(public_path('archivos/' . $libro->imagen_libro));
                }
                $file = $request->file('update_imagen_libro');
                $img = $file->getClientOriginalName();
                $img2 = $request->update_id_libro . $img;
                \Storage::disk('local')->put($img2, \File::get($file));
                $libro->imagen_libro = $img2;
            }
            $libro->save();

            return back()->with('success', 'Libro guardado');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el libro: ' . $e->getMessage());
        }
    }

    public function delete(Request $request){
         // VALIDAMOS QUE LOS DATOS ESTÁN LLEGANDO AL CONTROLADOR
         $this->validate($request,[
            'delete_id_libro' => ['required'],
        ]);

        try { 
            // buscamos el libro         
            $libro = Libros::findOrFail($request->delete_id_libro);

            // Eliminar la imagen asociada si existe
            if ($libro->imagen_libro && file_exists(public_path('archivos/' . $libro->imagen_libro))) {
                unlink(public_path('archivos/' . $libro->imagen_libro));
            }

            // borramos el libro
            $libro->delete();

            return back()->with('success', 'Libro eliminado');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el libro: ' . $e->getMessage());
        }

    }
}
