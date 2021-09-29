<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptoWalletPymentsTable extends Migration
{
    public function up()
    {
        Schema::create('crypto_wallet_pyments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('crypto_wallet_id');
            $table->timestamps();
            $table->softDeletes();
          
            $table->foreign('crypto_wallet_id')
                ->references('id')
                ->on('crypto_wallets')
                ->onDelete('cascade');
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crypto_wallet_pyments');
    }
}
