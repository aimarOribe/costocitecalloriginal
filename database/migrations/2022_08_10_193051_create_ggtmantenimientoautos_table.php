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
        Schema::create('ggtmantenimientoautos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->float('gasto',8,2);
            $table->integer('periodoanual');
            $table->float('porcentajeuso',8,2);
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
        Schema::dropIfExists('ggtmantenimientoautos');
    }
};
