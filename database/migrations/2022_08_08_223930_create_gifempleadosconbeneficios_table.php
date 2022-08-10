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
        Schema::create('gifempleadosconbeneficios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->float('sueldo');
            $table->integer('ntrabajadores');
            $table->unsignedBigInteger('regimenlaboral_id');
            $table->foreign('regimenlaboral_id')
                ->references('id')
                ->on('regimenlaboralconbeneficios');
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
        Schema::dropIfExists('gifempleadosconbeneficios');
    }
};
