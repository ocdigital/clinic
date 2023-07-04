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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('tipo', ['medicos', 'atendentes'])->after('email')->nullable();
            $table->string('profissao')->after('tipo')->nullable();
            $table->string('cbo')->after('profissao')->nullable();
        });
    }

  /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'profissao', 'cbo']);
        });
    }
};
