<?php

use Illuminate\Database\Seeder;
use App\Rol;
class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Rol::create(['name' => 'administrator']);
        $role = Rol::create(['name' => 'usuario']);
        $role = Rol::create(['name' => 'agente']);
    }
}
