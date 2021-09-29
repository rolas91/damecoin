<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeAccountStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_account_states', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(false);
            $table->unsignedInteger('stripe_account_id');
            $table->string('descripcion',150);
            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::dropIfExists('stripe_account_states');
    }
}
