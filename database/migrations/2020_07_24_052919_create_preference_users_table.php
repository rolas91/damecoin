<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferenceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locate');
            $table->integer('fiat_wallet_default')->unsigned();
            $table->integer('crypto_wallet_default')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('fiat_wallet_default')
            ->references('id')
            ->on('currencies')
            ->onDelete('cascade');

            $table->foreign('crypto_wallet_default')
            ->references('id')
            ->on('cryptos')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('preference_users');
    }
}
