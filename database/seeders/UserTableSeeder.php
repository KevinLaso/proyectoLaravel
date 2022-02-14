<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'Usuario';
        $user->email = 'usuario@gmail.com';
        $user->nombrecompleto = 'Pepe Pérez';
        $user->password = bcrypt('secreto2021');
        $user->save();
        $user->roles()->attach($role_user);  //Asignamos rol de usuario

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@gmail.com';
        $user->nombrecompleto = 'Kevin Laso';
        $user->password = bcrypt('secreto2021');
        $user->save();
        $user->roles()->attach($role_admin);  //Asignamos rol de administrador
    }
}
