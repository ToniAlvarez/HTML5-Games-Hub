<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoracions', function (Blueprint $table) {
            $table->primary(['user_id', 'juego_id']);
            $table->integer('puntuacion');
            $table->string('comentario');
            $table->integer('user_id')->unsigned();
            $table->integer('juego_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('juego_id')->references('id')->on('juegos')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE valoracions ADD id INTEGER NOT NULL UNIQUE AUTO_INCREMENT;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('juegos');
    }
}
