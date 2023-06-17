<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProntuariosTable extends Migration
{
    public function up()
    {
        Schema::create('prontuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paciente');
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->date('data_consulta');
            $table->text('sintomas');
            $table->text('diagnostico');
            $table->text('prescricao_medica');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prontuarios');
    }
}
