@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Modificar un usuario</h1>

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
        <form method="post" action="{{ route('users.update', $users->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="name">nombre:</label>
                <input type="text" class="form-control" 
                name="name" 
                value="{{ $users->name }}" />
            </div>

            <div class="form-group">
                <label for="email">email:</label>
                <input type="text" class="form-control" name="email" value="{{ $users->email }}" />
            </div>
            <div class="form-group">
                <label for="roles">rol:</label>
                <input type="text" class="form-control" name="roles" value="{{ $users->roles->get('name') }}" />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection