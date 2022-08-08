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
        Schema::table('types_conge', function (Blueprint $table) {
            $table->dropForeign(['frequence_solde_id']);
        });

        Schema::dropIfExists('etats_conge');

        Schema::create('etats_conge', function (Blueprint $table) {
            $table->id();
            $table->string('etat_conge')->nullable();
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
        Schema::table('etats_conge', function (Blueprint $table) {
            //
        });
    }
};
