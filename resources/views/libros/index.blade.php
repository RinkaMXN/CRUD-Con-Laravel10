@extends('plantilla.welcome')

<!-- Título de la página -->
@section('title', 'Tabla principal de libros')  

@section('content')


    <div class="container mt-5">
        <div class="mb-2">
            <button type="submit" class="btn btn-primary icon-size-zoom" data-bs-toggle="modal" data-bs-target="#modalCrear">
                Agregar
            </button>
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
                        <td>
                            <img src="{{ asset('archivos/' . $libro->imagen_libro) }}" alt="Imagen del libro" width="100">
                        </td>
                        <th scope="row">{{ $libro->id_libro }}</th>
                        <td>{{ $libro->titulo_libro }}</td>
                        <td>{{ $libro->nombre_autor }}</td>
                        <td>{{ $libro->descripcion_libro }}</td>
                        <td>{{ $libro->nombre_genero }}</td>
                        <td>{{ $libro->fecha_publicacion_libro }}</td> 
                        <td>

                            <button type="submit" class="btn btn-primary icon-size-zoom" data-bs-toggle="modal" data-bs-target="#modalEditar-{{ $libro->id_libro }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                           
                            <button type="button" class="btn btn-outline-danger icon-size-zoom" data-bs-toggle="modal" data-bs-target="#modalEliminar-{{ $libro->id_libro }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>



                            <!-- modal para editar libros -->
                            <div class="modal fade" id="modalEditar-{{ $libro->id_libro }}" tabindex="-1" role="dialog"  aria-labelledby="modalEditarLabel-{{ $libro->id_libro }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar libro</h5>
                                            <button type="button" class=" btn-close icon-size-zoom" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- formulario para actualizar datos -->
                                            <form action="{{ route('update') }}" method="post" enctype = "multipart/form-data">
                                                @csrf
                                                
                                                
                                                <div class="form-group mb-3">
                                                    <label for="update_id_libro">ID libro:</label>
                                                    <input type="text" class="form-control dis" id="update_id_libro" name="update_id_libro" value="{{ $libro->id_libro }}" readonly>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="update_titulo_libro">Titulo:</label>
                                                    <input type="text" class="form-control @error('update_titulo_libro') is-invalid @enderror" id="update_titulo_libro" name="update_titulo_libro" value="{{ $libro->titulo_libro }}">
                                                    @error('update_titulo_libro')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                
                                                <div class="form-group mb-3">
                                                    <label for="update_autor_libro">Autor:</label>
                                                    <select class="form-select" id="update_autor_libro" name="update_autor_libro" required>
                                                        @foreach ($autores as $au)
                                                            <option value="{{ $au->id_autor }}" 
                                                                {{ $libro->id_autor == $au->id_autor ? 'selected' : '' }}>
                                                                {{ $au->nombre_autor }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group mb-3">
                                                    <label for="update_genero_libro">Género:</label>
                                                    <select class="form-select" id="update_genero_libro" name="update_genero_libro" required>
                                                        @foreach ($generos as $ge)
                                                            <option value="{{ $ge->id_genero }}" 
                                                                {{ $libro->id_genero == $ge->id_genero ? 'selected' : '' }}>
                                                                {{ $ge->nombre_genero }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="update_fecha_publicacion_libro">Selecciona una fecha:</label>
                                                    <input type="date" class="form-control" id="update_fecha_publicacion_libro" name="update_fecha_publicacion_libro" value="{{ $libro->fecha_publicacion_libro}}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="update_descripcion_libro">Descripción:</label>
                                                    <textarea class="form-control" id="update_descripcion_libro" name = "update_descripcion_libro" rows="3" required>{{ $libro->descripcion_libro }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="update_imagen_libro">Imágen:</label>
                                                    <input type="file" class="form-control" id="update_imagen_libro" name="update_imagen_libro">
                                                    <small class="form-text text-muted">Imágen actual: 
                                                        <a href="{{ asset('archivos/' . $libro->imagen_libro) }}" target="_blank">Ver imágen</a>
                                                    </small>
                                                </div>

                                       
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>

                                            </form>
                                            <!-- end formulario para actualizar datos -->

                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end modal para editar libros -->

                            <!-- modal para eliminar libros -->
                            <div class="modal fade" id="modalEliminar-{{ $libro->id_libro }}" tabindex="-1" role="dialog"  aria-labelledby="modalEliminarLabel-{{ $libro->id_libro }}">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Eliminar libro</h5>
                                            <button type="button" class="btn-close icon-size-zoom" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- formulario para eliminar datos -->
                                            <form action="{{ route('delete') }}" method="post">
                                                @csrf
                                                
                                                <div class="form-group mb-3">
                                                    <label for="delete_id_libro">ID libro:</label>
                                                    <input type="text" class="form-control dis" id="delete_id_libro" name="delete_id_libro" value="{{ $libro->id_libro }}" readonly>
                                                </div>
                    
                                                <div class="form-group mb-3">
                                                    <label for="delete_titulo_libro">Titulo:</label>
                                                    <input type="text" class="form-control" id="delete_titulo_libro" name="delete_titulo_libro" value="{{ $libro->titulo_libro }}" disabled>                 
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="delete_autor_libro">Autor:</label>
                                                    <input type="text" class="form-control" id="delete_autor_libro" name="delete_autor_libro" value="{{ $libro->id_autor }}" disabled>                 
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="delete_genero_libro">Género:</label>
                                                    <input type="text" class="form-control" id="delete_genero_libro" name="delete_genero_libro" value="{{ $libro->id_genero }}" disabled>                 
                                                </div>

                                                
                                                <div class="form-group mb-3">
                                                    <label for="delete_fecha_publicacion_libro">Fecha:</label>
                                                    <input type="date" class="form-control" id="delete_fecha_publicacion_libro" name="delete_fecha_publicacion_libro" value="{{ $libro->fecha_publicacion_libro}}" disabled>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="delete_descripcion_libro">Descripción:</label>
                                                    <textarea class="form-control" id="delete_descripcion_libro" name = "delete_descripcion_libro" rows="3" disabled>{{ $libro->descripcion_libro }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="delete_imagen_libro">Imágen:</label>
                                                    <br>
                                                    <small class="form-text text-muted">Imágen actual: 
                                                        <a href="{{ asset('archivos/' . $libro->imagen_libro) }}" target="_blank">Ver imágen</a>
                                                    </small>
                                                </div>

                                       
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn btn-primary me-2">Eliminar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </form>
                                            <!-- end formulario para eliminar datos -->

                                        </div>                                      
                                    </div>
                                </div>
                            </div>
                            <!-- end modal para eliminar libros -->

                        </td>  
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- modal para crear libros -->
        <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear libro</h5>
                        <button type="button" class="btn-close icon-size-zoom" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- formulario para crear datos -->
                        <form action="{{ route('create') }}" method="post" enctype = "multipart/form-data">
                            @csrf
                            
                            
                            <div class="form-group mb-3">
                                <label for="create_id_libro">ID libro:</label>
                                <input type="text" class="form-control dis" id="create_id_libro" name="create_id_libro" value="{{ $idsigue }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="create_titulo_libro">Titulo:</label>
                                <input type="text" class="form-control @error('create_titulo_libro') is-invalid @enderror" id="create_titulo_libro" name="create_titulo_libro" value="{{ old('create_titulo_libro') }}" required>
                                @error('create_titulo_libro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="create_autor_libro">Autor:</label>
                                <select class="form-select" id="create_autor_libro" name="create_autor_libro" required>
                                    @foreach ($autores as $au)
                                        <option value="{{ $au->id_autor }}">
                                            {{ $au->nombre_autor }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="create_genero_libro">Género:</label>
                                <select class="form-select" id="create_genero_libro" name="create_genero_libro" required>
                                    @foreach ($generos as $ge)
                                        <option value="{{ $ge->id_genero }}">
                                            {{ $ge->nombre_genero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="create_fecha_publicacion_libro">Selecciona una fecha:</label>
                                <input type="date" class="form-control" id="create_fecha_publicacion_libro" name="create_fecha_publicacion_libro" value="{{ old('create_fecha_publicacion_libro') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="create_descripcion_libro">Descripción:</label>
                                <textarea class="form-control" id="create_descripcion_libro" name = "create_descripcion_libro" rows="3" required>{{ old('create_descripcion_libro')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="create_imagen_libro">Imágen:</label>
                                <input type="file" class="form-control" id="create_imagen_libro" name="create_imagen_libro">           
                            </div>
                   
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-2">Agregar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                        <!-- end formulario para actualizar datos-->
                    </div>                
                </div>
            </div>
        </div>
        <!-- end modal para crear libros -->
        </div>

        <script>
            @if ($errors->any())
                @if (old('create_id_libro'))
                    // Si hay errores en el formulario de crear
                    $(document).ready(function() {
                        $('#modalCrear').modal('show');
                    });
                @elseif (old('update_id_libro'))
                    // Si hay errores en el formulario de editar
                    $(document).ready(function() {
                        $('#modalEditar-{{ old('update_id_libro') }}').modal('show');
                    });
                @endif
            @endif
        </script>
@endsection