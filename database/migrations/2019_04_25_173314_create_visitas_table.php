<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('visitante_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('entrada');
            $table->dateTime('saida')->nullable();
            $table->integer('cracha')->unsigned();
            $table->integer('setor_id')->unsigned();
            $table->string('pessoa');
            $table->string('assunto');
            $table->timestamps();
            $table->foreign('visitante_id')->references('id')->on('visitantes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('setor_id')->references('id')->on('setors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('visitas');
    }
}
