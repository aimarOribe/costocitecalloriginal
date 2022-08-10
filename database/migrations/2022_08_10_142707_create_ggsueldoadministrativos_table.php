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
        Schema::create('ggsueldoadministrativos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->float('sueldomensualplanilla',8,2);
            $table->float('sueldosinplanilla',8,2);
            $table->unsignedBigInteger('regimenlaboral_id');
            $table->foreign('regimenlaboral_id')
                ->references('id')
                ->on('regimenlaboralgastoadministrativos');
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
        Schema::dropIfExists('ggsueldoadministrativos');
    }
};
