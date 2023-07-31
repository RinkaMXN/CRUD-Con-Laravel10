@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="container">
<h1>Modifica libro</h1>
<hr>
<form action = "{{route('ventana_guarda_cambios')}}" method = "POST" enctype = 'multipart/form-data'>
    {{csrf_field()}}
    <div class="well">
      <div class="form-group">
          <label for="dni">Clave de libro:

            @if($errors->first('IdLibro'))
            <p class = 'text-danger'>{{$errors->first('IdLibro')}}</IdLibro>
            @endif

          </label>
          <input type="text" name="IdLibro" id="IdLibro" value="{{$consulta->IdLibro}}"  readonly='readonly' class="form-control" placeholder="Clave de libro" tabindex="5">
      </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="titulo">Titulo:

                        @if($errors->first('Titulo'))
                        <p class = 'text-danger'>{{$errors->first('Titulo')}}</Titulo>
                        @endif

                    </label>
                <input type="text" name="Titulo" id="Titulo" value="{{$consulta->Titulo}}"   class="form-control" placeholder="Titulo" tabindex="1">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="autor">Autor:

                        @if($errors->first('Autor'))
                        <p class = 'text-danger'>{{$errors->first('Autor')}}</Autor>
                        @endif

                    </label>
                    <input type="text" name="Autor" id="Autor" value="{{$consulta->Autor}}"  class="form-control" placeholder="Autor" tabindex="2">
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
                    <input type="Editorial" name="Editorial" id="Editorial" value="{{$consulta->Editorial}}"  class="form-control" placeholder="Editorial" tabindex="4">
                </div>
            </div>

            <div class="col-xs-1 col-sm-1 col-md-1">
              <div class="form-group">
                <label for="dni">Género:</label>
                <select name = 'IdGenero' class="custom-select">
                  <option value="{{$consulta->IdGenero}}">{{$consulta->gen}}</option>
                  @foreach($generos as $gen)
                        <option value="{{$gen->IdGenero}}">{{$gen->Nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
      

        </div>

        <fieldset class="form-group">
         <legend class="mt-4"></legend>
         <div class="form-check">
           <input class="form-check-input" type="radio" name="Activo" value="Si" @if($consulta->Activo =='Si') checked @endif>
           <label class="form-check-label" for="optionsRadios1">
            Si
           </label>
         </div>
         <div class="form-check">
           <input class="form-check-input" type="radio" name="Activo" value="No" @if($consulta->Activo =='No') checked @endif>
           <label class="form-check-label" for="optionsRadios2">
            No
           </label>
         </div>
       </fieldset>


        <div class="form-group">
            <label for="dni">Descripción:</label>
            <textarea name="Descripcion" id="Descripcion"  class="form-control" tabindex="5">
                {{$consulta->Descripcion}}
            </textarea>
        </div>
        <div class="form-group">
            <label for="Img" class="form-label mt-4">Inserte Imagen del libro</label>
            <img src="{{asset('archivos/'.$consulta->Img)}}" height = 150  width=150 >
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
