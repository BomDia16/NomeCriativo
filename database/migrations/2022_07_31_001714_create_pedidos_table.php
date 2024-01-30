<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('ingresso_id');
            $table->integer('ingresso_qtd');
            $table->integer('total');
            $table->timestamps();

            // Foreign's Key
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ingresso_id')->references('id')->on('ingressos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
