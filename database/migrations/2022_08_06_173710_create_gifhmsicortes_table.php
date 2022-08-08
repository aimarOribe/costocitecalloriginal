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
        Schema::create('gifhmsicortes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->unsignedBigInteger('listaunidadmedida_id');
            $table->foreign('listaunidadmedida_id')
                ->references('id')
                ->on('listaunidaddemedidas');
            $table->float('valorunitario',8,2);
            $table->float('consumo',8,2);
            $table->integer('cantidadmeses');
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
        Schema::dropIfExists('gifhmsicortes');
    }
};
