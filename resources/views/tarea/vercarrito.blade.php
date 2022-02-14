@extends('layouts.app')

@section('content')

@if (session('carrito'))
<strong>Carrito de la compra</strong>
<table class="table table-striped">
<thead>
<th>producto</th>
<th>Descripción</th>
<th>Cantidad</th>
<th>Imagen</th>
<th>Precio</th>
</thead>
<tbody>

<a class="btn btn-primary" href="/borrarcarrito">Borrar Carrito</a>
<a class="btn btn-primary" style=" margin: 0 0 0 60px;" href="/comprar">Comprar</a>
@foreach (session('carrito') as $id=>$tarea)
<tr>
<td>{{ $tarea['titulo'] }}</td>
<td>{{ $tarea['descripcion'] }}</td>
<td>{{ $tarea['cantidad'] }}</td>
<td>
@if ( $tarea['imagen'] != "" )
<img src="/imagenes/{{ $tarea['imagen'] }}" height="100" alt="Imagen"/>
@else
Sin imagen
@endif
</td>
<td>{{ $tarea['precio'] }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>


@else
<h2>No hay productos en el carrito</h2>
@endif

@endsection