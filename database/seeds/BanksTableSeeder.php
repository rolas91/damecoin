<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            'destinatary' => 'Name',
            'name' => 'Bank',
            'title' => 'title',
            'country' => 'Country',
            'addres' => 'Address',
            'swift' => 'Swift',
            'numero_cuenta' => 'Account number',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
