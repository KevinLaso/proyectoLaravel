<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.inicio');
});

Route::get('/quienessomos', function () {
    return view('layouts.quienes');
});

Route::get('/Contacto', function () {
    return view('layouts.contacto');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Para acceder a todos los métodos automáticos del controlador
Route::resource('tareas', 'App\Http\Controllers\TareaController');

//Para acceder a los métodos creados manualmente
Route::get('/tareas/subirimagen/{id}', [App\Http\Controllers\TareaController::class, 'subirimagen'])->name('tareas.subirimagen');


/*Route::post('/tareas/subirimagenpost', ['as'=>'subir.imagen.post','uses'=>'UserController@subirimagenpost']);
*/
Route::post('/tareas/subirimagenpost', [ App\Http\Controllers\TareaController::class, 'subirimagenpost' ])->name('tareas.subirimagenpost');

Route::get('/tareas/añadircarrito/{id}', [ App\Http\Controllers\TareaController::class, 'añadirCarrito' ])->name('tareas.añadircarrito');
Route::get('/vercarrito', function () {
return view('tarea.vercarrito');
});
Route::get('/borrarcarrito', function () {
session()->forget('carrito');
return view('tarea.vercarrito');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', 'App\Http\Controllers\UserController');