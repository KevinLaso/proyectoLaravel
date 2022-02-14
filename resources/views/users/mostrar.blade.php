@extends('layouts.app') 

@section('content')
	@if( auth()->check() && auth()->user()->hasAnyRole('admin') ) 
    @if (count($users) > 0)
      <strong>Listado de usuarios</strong>      
        <table class="table table-striped">
            <thead>
                <th>nombre</th>
                <th>email</th>
                <th>Rol</th>
            </thead>
            <tbody>
                @foreach ($users as $user) 

                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles}}</td>
                        @if( auth()->check() && auth()->user()->hasAnyRole('admin') )
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Modificar</a>
                        </td>

                        <td>
                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit" onclick="return confirm('Esta seguro de que quiere eliminar el usuario: {{$user->name}}')">Eliminar</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    
        
    @endif

@endsection