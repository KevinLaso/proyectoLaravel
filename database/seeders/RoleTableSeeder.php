<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador: puede hacer cualquier cosa';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'Usuario: funciones limitadas';
        $role->save();
    }
}
