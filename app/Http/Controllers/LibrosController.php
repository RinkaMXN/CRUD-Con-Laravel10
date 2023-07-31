<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\libros;
use App\Models\generos;

class LibrosController extends Controller
{
    //
    public function ventana_borra_libro($IdLibro)
    {
        $libros = libros::withTrashed()->find($IdLibro)->forceDelete();
            return redirect()->route('ventana_reporte_de_libro');

    }

    public function ventana_activa_libro($IdLibro)
    {
        $libros = libros::withTrashed()
            ->where('IdLibro',$IdLibro)->restore();

            $libros2 = libros::find($IdLibro);
            $libros2->Activo = 'Si';
            $libros2->save();
            return redirect()->route('ventana_reporte_de_libro');

    }

    public function ventana_desactiva_libro($IdLibro)
    {
        $libros = libros::find($IdLibro);
            $libros->delete();
            $libros->Activo = 'No';
            $libros->save();
            return redirect()->route('ventana_reporte_de_libro');
    }



   
    public function ventana_guarda_cambios(Request $request)
    {
        $this->validate($request,[
            'Titulo' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü,Á,É,Í,Ó,Ú,Ü,Ñ,ñ]+$/',
            'Autor' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü,Á,É,Í,Ó,Ú,Ü,Ñ,ñ]+$/',
            'Editorial' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü,Á,É,Í,Ó,Ú,Ü,Ñ,ñ]+$/',
            'Img' => 'image|mimes:gif,jpeg,png'
        ]);
        $file = $request->file('Img');
        if($file != "")
        {
            $file = $request->file('Img');
            $img = $file->getClientOriginalName();
            $img2 = $request->IdLibro . $img;
            \Storage::disk('local')->put($img2, \File::get($file));
    
        }

        $libros = libros::withTrashed()->find($request->IdLibro);
        $libros->IdLibro = $request->IdLibro;
        $libros->Titulo = $request->Titulo;
        $libros->Autor = $request->Autor;
        $libros->Editorial = $request->Editorial;
        $libros->Activo = $request->Activo;
        $libros->Descripcion = $request->Descripcion;
        $libros->IdGenero = $request->IdGenero;
        if($file!="")
        {
            $libros->img = $img2;
        }
        
        $libros->save();

        return redirect()->route('ventana_reporte_de_libro');

    }





    public function ventana_modifica_libro($IdLibro)
    {
        $consulta = libros::withTrashed()->join('generos','libros.IdGenero','=','generos.IdGenero')
            ->select('libros.IdLibro','libros.Titulo','libros.Autor', 'libros.Descripcion', 'libros.Activo',
            'libros.Editorial','generos.Nombre as gen', 'libros.IdGenero', 'libros.Img')
            //,'libros.deleted_at'
            ->where('IdLibro',$IdLibro)
            ->get();
            $generos = generos::all();
            return view('crud.Modifica_libro')
            ->with('consulta',$consulta[0])
            ->with('generos',$generos);

    }


    public function ventana_reporte_de_libro()
    {

        $consulta = libros::orderBy('IdLibro','ASC')
            ->withTrashed()
            ->join('generos','libros.IdGenero','=','generos.IdGenero')
            ->select('libros.IdLibro','libros.Titulo','libros.Autor',
            'libros.Editorial','generos.Nombre as gen','libros.deleted_at','libros.Img')
            ->get();
            return view('crud.Reporte_de_libros')
            ->with('consulta',$consulta);
        
    }



    public function ventana_alta_de_libro()
    {
        $consulta = libros::orderBy('IdLibro','DESC')
                                ->take(1)
                                ->get();
        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idsigue = 1;
        }
        else
        {
            $idsigue = $consulta[0]->IdLibro+1;
        }
        $generos = generos::all();

        return view('crud.Alta_de_libro')
            ->with('idsigue',$idsigue)
            ->with('generos',$generos);
    }


    public function ventana_guardar_libro(Request $request)
    {
        $this->validate($request,[
            'Titulo' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü,Á,É,Í,Ó,Ú,Ü,Ñ,ñ]+$/',
            'Autor' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü,Á,É,Í,Ó,Ú,Ü,Ñ,ñ]+$/',
            'Editorial' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú,ü,Á,É,Í,Ó,Ú,Ü,Ñ,ñ]+$/',
            'Img' => 'image|mimes:gif,jpeg,png'
        ]);

        $file = $request->file('Img');
        if($file != "")
        {
            $file = $request->file('Img');
            $img = $file->getClientOriginalName();
            $img2 = $request->IdLibro . $img;
            \Storage::disk('local')->put($img2, \File::get($file));
    
        }
        else
        {
            $img2 = "no_foto.jpg";
        }

        $libros = new libros;
        $libros->IdLibro = $request->IdLibro;
        $libros->IdGenero = $request->IdGenero;
        $libros->Titulo = $request->Titulo;
        $libros->Autor = $request->Autor;
        $libros->Editorial = $request->Editorial;
        $libros->Activo = $request->Activo;
        $libros->Img = $img2;
        $libros->Descripcion = $request->Descripcion;
        $libros->save();
        return redirect()->route('ventana_reporte_de_libro');
    }
}
