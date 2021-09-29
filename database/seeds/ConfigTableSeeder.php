<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            'type' => 'publicKeyStripe',
            'value' => 'pk_live_kItjceYnckWiQVbXNGvfg6vQ00ZVxmbpqj'
        ]);

        DB::table('config')->insert([
            'type' => 'privateKeyStripe',
            'value' => 'sk_live_q7HWE8R1CTQbabUVi6vBDU5900QajLtcV5'
        ]);

        DB::table('config')->insert([
            'type' => 'masterPassword',
            'value' => '1234444'
        ]);
    }
}
