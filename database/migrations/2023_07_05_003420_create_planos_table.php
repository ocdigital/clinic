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
        Schema::create('planos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('convenio_id');
            $table->string('nome');
            $table->timestamps();

            $table->foreign('convenio_id')->references('id')->on('convenios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('planos');
    }
};
