<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->float('retiro',18,8)->default(0);
            $table->float('comision',18,8)->default(0);
            $table->string('wallet_externo');
            $table->unsignedInteger('crypto_wallet_id');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('crypto_wallet_id')
                ->references('id')
                ->on('crypto_wallets')
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
        Schema::dropIfExists('external_wallets');
    }
}
