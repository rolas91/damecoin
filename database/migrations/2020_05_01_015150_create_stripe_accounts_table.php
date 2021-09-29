<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('stripe_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stripe_id',50);
            $table->string('name',50);
            $table->boolean('secure_3d')->default(false);
            $table->string('user_by',50);
            $table->string('email_owner',50);
            $table->string('email_admin',50);
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('stripe_accounts');
    }
}
