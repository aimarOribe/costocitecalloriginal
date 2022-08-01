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
        Schema::create('manoobras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familia_id');
            $table->foreign('familia_id')
                ->references('id')
                ->on('familias');
            $table->unsignedBigInteger('modelo_id');
            $table->foreign('modelo_id')
                ->references('id')
                ->on('modelofamilias');
            $table->unsignedBigInteger('proceso_id');
            $table->foreign('proceso_id')
                ->references('id')
                ->on('listaprocesos');
            $table->integer('tiempohoras')->nullable();
            $table->double('costo',8,2)->nullable();
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
        Schema::dropIfExists('manoobras');
    }
};
