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
        // Schema::table('conges_types_conge', function (Blueprint $table) {
        //     $table->dropForeign(['conges_frequence_solde_id']);
        // });

        // drop the foreign etat_conge_id reference on the table conges
        Schema::table('conges', function (Blueprint $table) {
            $table->dropForeign(['etat_conge_id']);
        });

        Schema::dropIfExists('etats_conge');

        Schema::create('conges_etats_conge', function (Blueprint $table) {
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
