<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class paymentMethod extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'name' => 'Paypal',
            'amount' => '200',
            'convert' => '170.72',
            'file' => 'img/metodo-pago/QN0f72yOwLJN65d3w4IlcNVbB9TxGc1B4n2pHFr2.png',
            'form' => 1
        ]);
    }
}
