<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->float('abono',18,2)->default(0);
            $table->float('retiro',18,2)->default(0);
            $table->unsignedInteger('status');
            $table->string('descripcion')->nullable();
            $table->string('comments',200)->nullable();
            $table->enum('status_user', ['Aprobado', 'Pendiente','Rechazado']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('currency_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status')
                ->references('id')
                ->on('states')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('wallets');
    }
}
