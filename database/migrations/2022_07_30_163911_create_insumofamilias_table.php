<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumofamilias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familia_id');
            $table->foreign('familia_id')
                ->references('id')
                ->on('familias');
            $table->unsignedBigInteger('listafamiliamateriales_id');
            $table->foreign('listafamiliamateriales_id')
                ->references('id')
                ->on('listafamiliademateriales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumofamilias');
    }
};
