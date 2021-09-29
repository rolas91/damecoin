<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_account_details', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('retencions')->default(false);
            $table->float('mounts');
            $table->unsignedInteger('bank_id');
            $table->date('fecha');  
            $table->unsignedInteger('stripe_account_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onDelete('cascade');
            
            $table->foreign('stripe_account_id')
                ->references('id')
                ->on('stripe_accounts')
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
        Schema::dropIfExists('stripe_account_details');
    }
}
