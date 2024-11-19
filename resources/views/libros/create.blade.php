@extends('plantilla.welcome')

<!-- Título de la página -->
@section('title', 'Formulario crear libro')  

@section('content')
    <div class="container mt-5">
        <!-- Formulario para crear un libro -->
        <form action="create-libros" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">        
                <div class="col-6">    
                    <label for="create_id_libro">ID Libro:</label>
                    <input type="text" class="form-control" id="create_id_libro" name="create_id_libro" value="{{ $idsigue }}" readonly>
                    
                </div>
                <div class="col-6">
                    <label for="create_titulo_libro">Titulo:</label>
                    <input type="text" class="form-control @error('create_titulo_libro') is-invalid @enderror" id="create_titulo_libro" name="create_titulo_libro" placeholder="Ingrese el titulo del libro" value="{{ old('create_titulo_libro') }}">
                    @error('create_titulo_libro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-5">        
                <div class="col-4">
                    <label for="create_autor_libro" class="form-label">Autor:</label>
                    <select 
                        class="form-select @error('create_autor_libro') is-invalid @enderror" 
                        id="create_autor_libro" 
                        name="create_autor_libro" >
                        @foreach ($autores as $a)
                            <option value="{{ $a->id_autor }}">{{ $a->nombre_autor }}</option>
                        @endforeach
                    </select>
                    @error('create_autor_libro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="create_genero_libro" class="form-label">Género:</label>
                    <select 
                        class="form-select @error('create_genero_libro') is-invalid @enderror"
                        id="create_genero_libro" 
                        name="create_genero_libro" >
                        @foreach ($generos as $g)
                            <option value="{{ $g->id_genero }}">{{ $g->nombre_genero }}</option>
                        @endforeach
                    </select>
                    @error('create_genero_libro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">        
                    <label for="create_fecha_publicacion_libro" class="form-label">Fecha de publicación:</label>
                    <input type="date" class="form-control @error('create_fecha_publicacion_libro') is-invalid @enderror" id="create_fecha_publicacion_libro" name="create_fecha_publicacion_libro" value="{{ old('create_fecha_publicacion_libro') }}">
                    @error('create_fecha_publicacion_libro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-5">        
                <div class="col-12">
                    <label for="create_descripcion_libro" class="form-label">Descripción:</label>
                    <textarea class="form-control @error('create_descripcion_libro') is-invalid @enderror" 
                            id="create_descripcion_libro" 
                            name="create_descripcion_libro" 
                            rows="3">{{ old('create_descripcion_libro') }}</textarea>
                    @error('create_descripcion_libro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-5">        
                <div class="col-12">
                    <label for="create_imagen_libro" class="form-label">Imágen:</label>
                    <input class="form-control @error('create_imagen_libro') is-invalid @enderror" type="file" id="create_imagen_libro" name="create_imagen_libro" >
                    @error('create_imagen_libro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

