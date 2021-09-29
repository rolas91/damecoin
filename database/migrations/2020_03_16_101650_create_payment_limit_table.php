<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_limit', function (Blueprint $table) {
            $table->increments('id');
            $table->float('wechat_minimum');
            $table->float('card_minimum');
            $table->float('card_maximum');
            $table->float('bank_minimum');
            $table->float('bank_deposit_minimum');
            $table->float('paypal_minimum');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_limit');
    }
}