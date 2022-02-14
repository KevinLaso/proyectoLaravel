@extends('layouts.app')

@section('content')

	@if (count($tareas) > 0)
      <strong>Listado de Productos</strong>  

        <table  class="table table-striped"; >
            <thead>
                <th>Id</th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Precio   </th>
                <th>Carrito</th>
            </thead>
            <tbody>
                @foreach ($tareas as $tarea) 
                    <tr>
                        <td>{{ $tarea->id }}</td>
                        <td>{{ $tarea->titulo }}</td>
                        <td>{{ $tarea->descripcion }}</td>


                        <td>
                        @if ( $tarea->imagen != "" )
                              <img src="/imagenes/{{ $tarea->imagen }}" width="100" alt="Imagen"/>
                        @else
                              Sin imagen
                        @endif
                        </td>

                        <td>{{ $tarea->precio }}</td>
                        
                        
                        <td>
<a href="{{ route('tareas.añadircarrito', $tarea->id) }}" class="btn btn-primary">Añadir al carrito</a>
</td>

                        @if( auth()->check() && auth()->user()->hasRole('admin') )
                        <td>
                            <a href="/tareas/subirimagen/{{ $tarea->id }}">Subir imagen</a>
                        </td>
                        <td>
                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-primary">Modificar</a>
                        
                            <form action="{{ route('tareas.destroy', $tarea->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit" onclick="return confirm('Esta seguro de que quiere eliminar la tarea: {{$tarea->titulo}}')">Eliminar</button>
                            </form>
                        </td>
                        
                        @endif
                        <td>
                            @if( auth()->check() && auth()->user()->hasRole('user') )
                         <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-primary">Comprar</a>
                            @endif
                         </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
   

    @if( auth()->check() && auth()->user()->hasAnyRole('admin') )
        <a href="{{ route('tareas.create') }}">Nueva tarea</a>
    @endif

@endsection
<td>

</td>