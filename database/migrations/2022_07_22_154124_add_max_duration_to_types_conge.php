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
            $table->string('max_duration')->comment('durée en DateInterval')->nullable();
            $table->foreignId('frequence_solde_id')->constrained('frequences_solde')->onUpdate('cascade')->onDelete('cascade')->comment('frequence de solde : mensuelle, trimestrielle, annuelle');
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
