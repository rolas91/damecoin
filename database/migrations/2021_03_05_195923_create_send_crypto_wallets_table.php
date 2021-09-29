<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendCryptoWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_crypto_wallets', function (Blueprint $table) {
        $table->increments('id');
            $table->string('account',1000);
            $table->string('platform',1000);
            $table->unsignedInteger('crypto_wallets_id');
            $table->unsignedInteger('currencies_id');
            $table->timestamps();

            $table->foreign('crypto_wallets_id')
                ->references('id')
                ->on('crypto_wallets');
            $table->foreign('currencies_id')
                ->references('id')
                ->on('currencies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_crypto_wallets');
    }
}
