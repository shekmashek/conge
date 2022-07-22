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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_conge_id')->constrained('types_conge')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('employe_id')->constrained('employes')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('debut')->nullable();
            $table->datetime('fin')->nullable();
            $table->string('intervale')->comment('duree en string DateInterval')->nullable();
            $table->integer('duree_min')->comment('durée en minute')->nullable();
            $table->string('motif')->nullable();
            $table->foreignId('etat_conge_id')->constrained('etats_conge')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('conges');
    }
};
