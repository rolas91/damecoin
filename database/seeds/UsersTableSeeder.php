<?php
use Illuminate\Support\Str;
//use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use App\User;
use App\Rol;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create('es_VE');

        $rolAdmin = Rol::where('name', 'administrator')->first();
        $rolUser = Rol::where('name','usuario')->first();
        $rolAgente = Rol::where('name','agente')->first();
        
        // Admin
        $user = new User;
            $user->rol()->associate($rolAdmin);
            $user->name ="admin";
            $user->lastName ="admin";
            $user->country_id=$faker->numberBetween(1,10);
            $user->email = 'admin@gmail.com';
            $user->password = bcrypt('admin');
            $user->remember_token = $faker->shuffle('ofjsyekfuehgmageptje');
        $user->save();
        
        $user = new User;
            $user->rol()->associate($rolAdmin);
            $user->name ="admin";
            $user->lastName ="houltman";
            $user->country_id=$faker->numberBetween(1,10);
            $user->email = 'houltman@gmail.com';
            $user->password = bcrypt('admin');
            $user->remember_token = $faker->shuffle('ofjsyekfuehgmageptje');
        $user->save();
        
        // Agente
        for($i=0;$i<=3;$i++) {
            $user = new User;
            $user->rol()->associate($rolAgente);
            $user->name = $faker->firstname;
            $user->lastName = $faker->lastname;
            $user->country_id=$faker->numberBetween(1,10);
            $user->email = Str::random(10).'@gmail.com';
            $user->password = bcrypt('password');
            $user->remember_token = $faker->shuffle('ofjsyekfuehgmageptje');
            $user->save();
        }

        // User
        for($i=0;$i<=3;$i++) {
            $user = new User;
            $user->rol()->associate($rolUser);
            $user->name = $faker->firstname;
            $user->lastName = $faker->lastname;
            $user->country_id=$faker->numberBetween(1,10);
            $user->email = Str::random(10).'@gmail.com';
            $user->password = bcrypt('password');
            $user->remember_token = $faker->shuffle('ofjsyekfuehgmageptje');
            $user->save();
        }

    }  
}
