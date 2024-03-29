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
        Schema::dropIfExists('types_conge');
        Schema::dropIfExists('conges_types_conge');

        Schema::create('conges_types_conge', function (Blueprint $table) {
            $table->id();
            $table->string('type_conge');
            $table->string('couleur')->nullable();
            $table->string('max_duration')->comment('durée en DateInterval')->nullable();
            $table->integer('duree_max')->comment("unité de base d' heure : minute")->nullable();
            $table->string('solde_format')->comment("type string : DateInterval")->nullable();
            $table->integer('solde')->comment('Solde mensuelle en unité de temps: minute')->nullable();

            $table->foreignId('frequence_solde_id')->constrained('conges_frequences_solde')->onUpdate('cascade')->onDelete('cascade')->comment('frequence de solde : mensuelle, trimestrielle, annuelle');
            $table->boolean('paye')->nullable()->comment('0 : non paye, 1 : paye');

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
        Schema::table('types_conge', function (Blueprint $table) {
            //
        });
    }
};
