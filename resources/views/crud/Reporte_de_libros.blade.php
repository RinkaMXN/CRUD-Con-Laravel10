@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <p></p>


<div class="container">
    <h1>REPORTE DE LIBROS</h1>
    <a href="{{route('ventana_alta_de_libro')}}">
      <button type="button" class="btn btn-outline-success">Alta de libro</button>
    </a>
    <br>
    <br>
    @if(Session::has('mensaje'))
    <div class="alert alert-success">{{Session::get('mensaje')}}</div>
    @endif
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Foto</th>
      <th scope="col">Clave</th>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">Editorial</th>
      <th scope="col">Género</th>
      <th scope="col">Operaciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($consulta as $c)
    <tr>
      <td><img src="{{asset('archivos/'.$c->Img)}}" height = 50  width=50 ></td>
      <th scope="row">{{$c->IdLibro}}</th>
      <td>{{$c->Titulo}}</td>
      <td>{{$c->Autor}}</td>
      <td>{{$c->Editorial}}</td>
      <td>{{$c->gen}}</td>
      <td>
        <a href="{{route('ventana_modifica_libro',['IdLibro'=>$c->IdLibro])}}">
          <button type="button" class="btn btn-outline-light">Modificar</button>
        </a>
        @if($c->deleted_at)
          <a href="{{route('ventana_activa_libro',['IdLibro'=>$c->IdLibro])}}">
          <button type="button" class="btn btn-outline-warning">Activar</button>
          </a>
          <a href="{{route('ventana_borra_libro',['IdLibro'=>$c->IdLibro])}}">
          <button type="button" class="btn btn-outline-dark">Borrar</button>
          </a>
          @else
          <a href="{{route('ventana_desactiva_libro',['IdLibro'=>$c->IdLibro])}}">
          <button type="button" class="btn btn-outline-danger">Desactivar</button>
          </a>
          @endif

      </td>
    </tr>
    @endforeach
  </tbody>
</table>



</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop