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
        Schema::create('deps', function (Blueprint $table) {
            $table->id();
            $table->string('activo');
            $table->string('fecha');
            $table->float('costodolar',8,2);
            $table->float('cambiodolarfechacompra',8,2);
            $table->float('costosoles',8,2);
            $table->integer('unidades');
            $table->float('costototal',8,2);
            $table->integer('aniosadepreciar');
            $table->float('valorresidual',8,2);
            $table->float('depreciacionanual',8,2);
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
        Schema::dropIfExists('deps');
    }
};
