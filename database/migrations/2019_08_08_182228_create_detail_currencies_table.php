<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('detail_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->float('min_deposito');
            $table->float('max_deposito');
            $table->integer('comision_retiro');
            $table->integer('comision_abono');
            $table->unsignedInteger('currency_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('detail_currencies');
    }
}
