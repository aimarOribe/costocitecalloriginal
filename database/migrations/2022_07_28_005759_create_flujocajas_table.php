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
        Schema::create('flujocajas', function (Blueprint $table) {
            $table->id();
            $table->string('mes');
            $table->string('fecha');
            $table->unsignedBigInteger('clasificacion_id');
            $table->foreign('clasificacion_id')
                ->references('id')
                ->on('clasificacions');
            $table->string('detalle');
            $table->string('responsable');
            $table->double('ingreso',8,2);
            $table->double('egreso',8,2);
            $table->string('documento');
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
        Schema::dropIfExists('flujocajas');
    }
};
