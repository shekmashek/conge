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
        Schema::dropIfExists('frequences_solde');
        // drom the table in sql

        Schema::create('conges_frequences_solde', function (Blueprint $table) {
            $table->id();
            $table->string('frequence')->comment('Mensuelle, trimestrielle, annuelle');
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
        Schema::dropIfExists('frequence_solde');
    }
};
