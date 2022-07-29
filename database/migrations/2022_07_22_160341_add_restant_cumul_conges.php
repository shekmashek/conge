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
        Schema::table('conges', function (Blueprint $table) {
            $table->string('cumul_perso')->comment('Cumul de jour soldé : en string DateInterval')->nullable();
            $table->double('j_utilise')->comment('Jour à déduire : 1/1.5/0.5')->nullable();
            $table->string('restant')->comment('Jours restant après demande : en string DateInterval')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conges', function (Blueprint $table) {
            //
        });
    }
};
