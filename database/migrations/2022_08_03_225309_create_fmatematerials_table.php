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
        Schema::create('fmatematerials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familiamateriales_id');
            $table->foreign('familiamateriales_id')
                ->references('id')
                ->on('listafamiliademateriales');
            $table->string('nombre');
            $table->unsignedBigInteger('listaunidadmedida_id');
            $table->foreign('listaunidadmedida_id')
                ->references('id')
                ->on('listaunidaddemedidas');
            $table->string('presentacion');
            $table->integer('stock')->default(0);
            $table->float('costopromedio',8,2)->default(0.00);
            $table->float('costoreal',8,2)->default(0.00);
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
        Schema::dropIfExists('fmatematerials');
    }
};
