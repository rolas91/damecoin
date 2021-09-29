<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentLimitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_limit')->insert([
            'card_minimum' => 100,
            'card_maximum' => 500,
            'wechat_minimum' => 60,
            'bank_minimum' => 400,
            'bank_deposit_minimum' => 1500,
            'paypal_minimum' => 100,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
