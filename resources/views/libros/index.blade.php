@extends('plantilla.welcome')

<!-- Título de la página -->
@section('title', 'Tabla principal de libros')  

@section('content')
    

    <div class="container mt-5">
        <div class="mb-2">
            <a href="{{ route('create') }}" class="btn btn-primary icon-size-zoom">
                Agregar
            </a>
        </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Imágen</th>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Género</th>
                    <th scope="col">Publicación</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libros as $libro)
                    <tr>
                    <td><img src="{{ $libro->imagen_libro }}" alt="Imagen del libro" width="100"></td>
                        <th scope="row">{{ $libro->id_libro }}</th>
                        <td>{{ $libro->titulo_libro }}</td>
                        <td>{{ $libro->nombre_autor }}</td>
                        <td>{{ $libro->descripcion_libro }}</td>
                        <td>{{ $libro->nombre_genero }}</td>
                        <td>{{ $libro->fecha_publicacion_libro }}</td> 
                        <td>
                            <button type="button" class="btn btn-primary icon-size-zoom">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger icon-size-zoom">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>  
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection