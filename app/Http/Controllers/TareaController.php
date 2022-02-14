<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{

    public function __construct()
        {
            //El middleware permite que solo los usuarios que ha iniciado sesión
            //puedan usar este controlador, es decir, hacer las operaciones del CRUD tareas
            
        }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Qué hace: Mostrar todas las tareas

        //1. Llamamos al modelo para pedir los registros de todas las tareas
        $tareas = Tarea::orderBy('created_at', 'asc')->get();

        //2. Devolvemos la vista al usuario pasándole como parámetro los datos anteriores
        return view('tarea.mostrar', ['tareas' => $tareas]);

        //return view('tarea.mostrar', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Mostramos la vista para crear la tarea
        Auth::user()->authorizeRoles('admin');

        return view('tarea.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles('admin');

        //1º Validar en el servidor
        $request->validate([
            'titulo'=>'required|max:100',
            'descripcion'=>'required|max:255',
            'precio'=>'required|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Asignamos el nuevo nombre de la imagen, asignando un nombre aleatorio
        $imageName = time().'.'.request()->imagen->getClientOriginalExtension();

        //Movemos la imagen al directorio imagenes de la carpeta public
        request()->imagen->move(public_path('imagenes'), $imageName);

        //2º Insertamos en el registro en la tabla
        $tarea = new Tarea([
            'titulo' => $request->get('titulo'),
            'descripcion' => $request->get('descripcion'),
            'precio' => $request->get('precio'),
            'imagen' => $imageName,
        ]);
        $tarea->save();//Guardar en la tabla

        return redirect('/tareas')->with('success', 'Tarea guardada!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->authorizeRoles('admin');

        //Localizamos la tarea por su id pasado como parámetro
        $tarea = Tarea::find($id); 

        //Mostramos la vista resources/views/tarea/editar.blade.php
        //pasando a la vista la variable $tarea con los datos de la tarea
        return view('tarea.editar', compact('tarea'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Auth::user()->authorizeRoles('admin');

        $request->validate([
            'titulo'=>'required',
            'descripcion'=>'required',
        ]);

        $tarea = Tarea::find($id);
        $tarea->titulo =  $request->get('titulo');
        $tarea->descripcion = $request->get('descripcion');
        $tarea->save();

        return redirect('/tareas')->with('success', 'Tarea actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->authorizeRoles('admin');

        $tarea = Tarea::find($id);

        $tarea->delete();

        return redirect('/tareas')->with('success', 'Tarea eliminada!');
    }

    public function subirimagen($id)
    {
        return view('tarea.subirimagen', ['id' => $id]); //Presentamos la vista subirimagen de la carpeta user
    }

    public function subirimagenpost()
    {
        //Validamos el formato de la imagen y que es obligatoria
        request()->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Asignamos el nuevo nombre de la imagen, asignando un nombre aleatorio
        $imageName = time().'.'.request()->imagen->getClientOriginalExtension();

        //Movemos la imagen al directorio imagenes de la carpeta public
        request()->imagen->move(public_path('imagenes'), $imageName);

        //Escribimos el nombre de la imagen en public/imagenes
        // - obtenemos el usuario por su id
        // - modificamos el campo imagen
        $id = request()->id;
        $tarea = Tarea::find($id);
        $tarea->imagen = $imageName;
        $tarea->save();

        //Volvemos (back) al formulario de la imagen
        //enviando los datos en la sesión con ->with()
        return back()
            ->with('exito','La imagen se ha cargado correctamente.')
            ->with('imagen', $imageName);

    }
    public function añadirCarrito($id)
{

   $tarea = Tarea::find($id);

   if( ! $tarea ){
      abort(404);
   }

$carrito = session()->get('carrito');

if( ! $carrito ){
$carrito = array(
$id => [
"titulo" => $tarea->titulo,
"cantidad" => 1,
"descripcion" => $tarea->descripcion,
"precio" => $tarea->precio,
"imagen" => $tarea->imagen
]
);

session()->put('carrito', $carrito);
return redirect()->back()->with('success', 'Tarea añadida al carrito!');
}

if(isset($carrito[$id])) {

$carrito[$id]['cantidad']++;
session()->put('carrito', $carrito);
return redirect()->back()->with('success', 'Tarea añadida al carrito!');
}

$carrito[$id] = [
"titulo" => $tarea->titulo,
"cantidad" => 1,
"descripcion" => $tarea->descripcion,
"precio" => $tarea->precio,
"imagen" => $tarea->imagen
];

session()->put('carrito', $carrito);

return back()
->with('exito','Tarea añadida al carrito!');

}
public function verCarrito()
{

$carrito = session()->all();
return view('tarea.vercarrito', compact('carrito'));
}

}

