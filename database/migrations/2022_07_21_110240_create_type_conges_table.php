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
        Schema::create('types_conge', function (Blueprint $table) {
            $table->id();
            $table->string('type_conge');
            $table->string('couleur')->nullable();
            $table->integer('nbr_min_max')->comment("unité de base d' heure : minute")->nullable();
            $table->integer('solde')->comment('Solde mensuelle en unité de temps: minute')->nullable();

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
        Schema::dropIfExists('type_conges');
    }
};
