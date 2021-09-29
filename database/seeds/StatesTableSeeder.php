<?php

use Illuminate\Database\Seeder;
use App\State;
class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = State::create(['name' => 'procesado']);
        $role = State::create(['name' => 'no-procesado']);
    }
}
