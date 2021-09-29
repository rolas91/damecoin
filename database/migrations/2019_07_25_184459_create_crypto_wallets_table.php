<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptoWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->float('compra',18,8)->default(0);
            $table->float('venta',18,8)->default(0);
            $table->float('taker',18,8);
            $table->unsignedInteger('status');
            $table->string('comments',1000);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('cripto_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('status')
                ->references('id')
                ->on('states')
                ->onDelete('cascade');
            $table->foreign('cripto_id')
                ->references('id')
                ->on('cryptos')
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
        Schema::dropIfExists('crypto_wallets');
    }
}
