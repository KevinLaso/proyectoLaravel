@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Modificar una tarea</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('tareas.update', $tarea->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" value="{{ $tarea->titulo }}" />
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" value="{{ $tarea->descripcion }}" />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection