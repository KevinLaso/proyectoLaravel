@extends('layouts.app')
@section('content')

        <!--
            Presentamos mensaje de éxito si todo va OK, solo si hemos cargado la imagen
        -->
        @if ( $mensaje = Session::get('exito'))

            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('exito') }}</strong>
            </div>

            <img src="/imagenes/{{ Session::get('imagen') }}" width="150">
            <p><a href="{{ route('tareas.index') }}">Aceptar la imagen y volver a mostrar tareas</a></p>

        @endif

        <!--
            Presentamos mensajes de error si algo falla, solo si hemos cargado la imagen
        -->
        @if (count($errors) > 0)

            <div class="alert alert-danger">
                <strong>Error</strong> Hubo problemas con la subida.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        <!--
            Presentamos el formulario para subir la imagen
            En un campo oculto ponemos el valor del id del usuario, para saber a qué usuario asignamos la imagen
        -->
        <p>Subir la imagen de usuario</p>
        <form action="{{ route('tareas.subirimagenpost', $id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-6">

                    <input type="hidden" name="id" value="{{ $id }}"/>
                    <input class="form-control" type="file" name="imagen" />

                </div>

                <div class="col-md-6">

                    <button type="submit" class="btn btn-success">Cargar imagen</button>

                </div>

            </div>

        </form>

@endsection