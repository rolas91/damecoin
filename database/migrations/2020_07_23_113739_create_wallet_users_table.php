<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('wallet_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('public_key')->nullable();
            $table->string('private_key')->nullable();
            $table->string('amount')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();

            $table->integer('user')->unsigned();
            $table->foreign('user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('wallet_users');
    }
}
