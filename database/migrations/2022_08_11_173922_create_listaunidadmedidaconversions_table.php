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
        Schema::create('listaunidadmedidaconversions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listaunidadmedida_id');
            $table->foreign('listaunidadmedida_id')
                ->references('id')
                ->on('listaunidaddemedidas');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')
                ->references('id')
                ->on('fmatematerials');
            $table->float('conversion',8,2);
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
        Schema::dropIfExists('listaunidadmedidaconversions');
    }
};
