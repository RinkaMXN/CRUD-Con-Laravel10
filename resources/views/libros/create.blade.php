@extends('plantilla.welcome')

<!-- Título de la página -->
@section('title', 'Formulario crear libro')  

@section('content')

    <div class="container mt-5">
        <!-- Formulario para crear un libro -->
        <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">        
                <div class="col-6">    
                    <label for="create_id_libro">ID Libro:</label>
                    <input type="text" class="form-control" id="create_id_libro">
                    
                </div>
                <div class="col-6">
                    <label for="create_titulo_libro">Titulo:</label>
                    <input type="text" class="form-control" id="create_titulo_libro" placeholder="Ingrese el titulo del libro">
                    
                </div>
            </div>

            <div class="row mt-5">        
                <div class="col-4">
                    <label for="create_autor_libro" class="form-label">Autor:</label>
                    <select class="form-select" aria-label="Default select example">
                        @foreach ($autores as $a)
                            <option value="{{ $a->id_autor }}">{{ $a->nombre_autor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="create_genero_libro" class="form-label">Género:</label>
                    <select class="form-select" aria-label="Default select example">
                        @foreach ($generos as $g)
                            <option value="{{ $g->id_genero }}">{{ $g->nombre_genero }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">        
                    <label for="create_fecha_publicacion_libro" class="form-label">Fecha de publicación:</label>
                    <input type="date" class="form-control" id="create_fecha_publicacion_libro" name="fecha_publicacion_libro">
                </div>
            </div>

            <div class="row mt-5">        
                <div class="col-12">
                    <label for="create_descripción_libro" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="create_descripción_libro" rows="3"></textarea>
                </div>
            </div>

            <div class="row mt-5">        
                <div class="col-12">
                    <label for="create_imagen_libro" class="form-label">Imágen:</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="row mt-5">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary icon-size-zoom">Crear Libro</button>
                </div>
            </div>
            <br>
        </form>       
    </div>
@endsection

