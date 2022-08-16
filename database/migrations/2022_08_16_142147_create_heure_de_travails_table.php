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
        Schema::create('heures_de_travail', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->comment('Heures de jour ou de nuit');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->time('debut_pause')->comment('ex : déjeuner à 12h00');
            $table->time('fin_pause');
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
        Schema::dropIfExists('heure_de_travails');
    }
};
