
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>proyecto kevin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

    

    <!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

   

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/navbar-top.css') }}" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/quienessomos">Quienes somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Contacto" >Contacto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tareas">Tienda</a>
        </li>
        @if( ! Auth::check() )
          <li class="nav-item">
            <a style="margin-left: 600px ;" class="nav-link" href="/login">Entrar</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="/register">Quiero registrarme</a>
          </li>
        @else
          
          @if( auth()->check() && auth()->user()->hasAnyRole('admin') ) 
          <li class="nav-item">
            <a class="nav-link" href="/users">Usuario</a>
          </li>
          @endif
          <li class="nav-item">

    <span style="float: right; margin: 0 15px 0 600px" class="usuario"> {{ Auth::user()->name }}</span>
  </li>
 
          
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" value="Salir"/>
          </form>
            
           
          
          @if(session('carrito'))
<span style="color:white;font-size:10pt">&nbsp;{{count(session('carrito'))}} productos en el carrito&nbsp;</span>

<a class="btn btn-primary" href="vercarrito">Ver Carrito</a>
@endif
        @endif


      </ul>
      <!--form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form-->
    </div>
  </div>
</nav>

<main class="container">
  @yield('content')
</main>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

      
  </body>
</html>
