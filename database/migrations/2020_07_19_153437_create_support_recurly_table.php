<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportRecurlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_recurly', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('default_conversion')->default(false);
            $table->string('note',255);
            $table->integer('currency_default');
            $table->unsignedInteger('stripe_account_id');
            $table->unsignedInteger('currency_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('stripe_account_id')
                ->references('id')
                ->on('stripe_accounts')
                ->onDelete('cascade');
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
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
        Schema::dropIfExists('support_recurly');
    }
}
