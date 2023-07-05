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
        Schema::create('convenios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('registro');
            $table->string('nome');
            $table->bigInteger('carencia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('convenios');
    }
};