<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;
class TareaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarea = new Tarea();
        $tarea->titulo = 'Tarea1';
        $tarea->descripcion = 'Esta es la tarea 1';
        $tarea->precio = '000';
        $tarea->save();

        $tarea = new Tarea();
        $tarea->titulo = 'Tarea2';
        $tarea->descripcion = 'Esta es la tarea 2';
        $tarea->precio = '000'
        $tarea->save();
    }
}
