<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMotifCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_motif_conges', function (Blueprint $table) {
            $table->id();
            $table->String('nom_motif');
            $table->boolean('etat_paiement');
            $table->integer('nombre_jour');
            $table->for('frequence_solde_id');
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
        Schema::dropIfExists('type_motif_conges');
    }
}
