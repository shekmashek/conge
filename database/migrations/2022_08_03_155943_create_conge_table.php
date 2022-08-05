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
            $table->id();
            $table->foreignId('type_conge_id')->constrained('types_conge')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('employe_id')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('debut')->nullable();
            $table->datetime('fin')->nullable();
            $table->string('intervale')->comment('duree en string DateInterval')->nullable();
            $table->integer('duree_conge')->comment('durée en minute')->nullable();

            $table->text('motif')->nullable();
            $table->foreignId('etat_conge_id')->constrained('etats_conge')->onUpdate('cascade')->onDelete('cascade')->default(3);

            $table->string('cumul_perso')->comment('Cumul de jour personnel : en string DateInterval')->nullable();
            $table->double('j_utilise')->comment('Jour à déduire : 1/1.5/0.5')->nullable();
            $table->string('restant')->comment('Jours restant après demande : en string DateInterval')->nullable();

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
        Schema::table('conges', function (Blueprint $table) {
            //
        });
    }
};
