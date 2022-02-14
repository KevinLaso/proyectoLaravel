<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\role;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Qué hace: Mostrar todas las tareas

            //1. Llamamos al modelo para pedir los registros de todas las tareas
            $users = user::orderBy('created_at', 'asc')->get();
            $roles = role::orderBy('created_at', 'asc')->get();

            //2. Devolvemos la vista al usuario pasándole como parámetro los datos anteriores
            return view('users.mostrar', compact('users'));
            return view('users.mostrar', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        
        //Localizamos la tarea por su id pasado como parámetro
        $users = user::find($id); 
        //Mostramos la vista resources/views/tarea/editar.blade.php
        //pasando a la vista la variable $tarea con los datos de la tarea
        return view('users.edit', compact('users')); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $user_id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required'
        ]);

        $users = user::find($id);
        $users->name =  $request->get('name');
        $users->email = $request->get('email');
        $user->roles = $request->get('name');
        $users->save();

        return redirect('/users')->with('success', 'usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
        $users = user::find($id);
        $users->delete();

        //Al final mostramos todas las tareas
        return redirect('/users')->with('success', 'usuario eliminado');
    }
    }
}
