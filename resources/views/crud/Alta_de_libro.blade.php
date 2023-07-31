@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <p></p>
<div class="container">
<h1>Alta de libro</h1>
<hr>
<form action = "{{route('ventana_guardar_libro')}}" method = "POST" enctype = 'multipart/form-data'>
    {{csrf_field()}}
    <div class="well">
      <div class="form-group">
          <label for="dni">Clave de libro:

            @if($errors->first('IdLibro'))
            <p class = 'text-danger'>{{$errors->first('IdLibro')}}</idl>
            @endif

          </label>
          <input type="text" name="IdLibro" id="IdLibro"" value="{{$idsigue}}"  readonly='readonly' class="form-control" placeholder="Clave de libro" tabindex="5">
      </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="Titulo">Titulo:

                        @if($errors->first('Titulo'))
                        <p class = 'text-danger'>{{$errors->first('Titulo')}}</Titulo>
                        @endif

                    </label>
                <input type="text" name="Titulo" id="Titulo" value="{{old('Titulo')}}"   class="form-control" placeholder="Titulo" tabindex="1">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="Autor">Autor:

                        @if($errors->first('Autor'))
                        <p class = 'text-danger'>{{$errors->first('Autor')}}</Autor>
                        @endif

                    </label>
                    <input type="text" name="Autor" id="Autor" value="{{old('Autor')}}"  class="form-control" placeholder="Autor" tabindex="2">
                </div>
            </div>
            
        </div>

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="Editorial">Editorial:
                        
                        @if($errors->first('Editorial'))
                        <p class = 'text-danger'>{{$errors->first('Editorial')}}</Editorial>
                        @endif

                    </label>
                    <input type="Editorial" name="Editorial" id="Editorial" value="{{old('Editorial')}}"  class="form-control" placeholder="Editorial" tabindex="4">
                </div>
            </div>

            <div class="col-xs-1 col-sm-1 col-md-1">
              <div class="form-group">
                <label for="dni">Género:</label>
                <select name = 'IdGenero' class="custom-select">
                  <option selected="">Selecciona un género</option>
                  @foreach($generos as $gen)
                        <option value="{{$gen->IdGenero}}">{{$gen->Nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            
      

        </div>



        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="dni">Activo:</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="Activo1" name="Activo"  value = "Si" class="custom-control-input" checked="">
                    <label class="custom-control-label" for="Activo1">Si</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="Activo2" name="Activo" value = "No" class="custom-control-input">
                    <label class="custom-control-label" for="Activo2">No</label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="dni">Descripción:
                @if($errors->first('Descripcion'))
                    <p class = 'text-danger'>{{$errors->first('Descripcion')}}</Descripcion>
                @endif
            </label>
            <textarea name="Descripcion" id="Descripcion" value="{{old('Descripcion')}}" class="form-control" tabindex="5">
            </textarea>
        </div>
        <div class="form-group">
            <label for="img" class="form-label mt-4">Inserte Imagen del libro</label>
            <input class="form-control" type="file" name="Img" id="Img">
            @if($errors->first('Img'))
                <p class = 'text-danger'>{{$errors->first('Img')}}</Descripcion>
            @endif
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-xs-6 col-md-6"><input type="submit" value="Guardar" class="btn btn-danger btn-block btn-lg" tabindex="7"
                title="Guardar datos ingresados"></div>
        </div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop