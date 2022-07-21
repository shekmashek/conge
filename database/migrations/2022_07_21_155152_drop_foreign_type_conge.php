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
        Schema::disableForeignKeyConstraints();
        Schema::table('conges', function (Blueprint $table) {
            $table->dropForeign('conges_type_conge_id_foreign');
        });
        Schema::table('conges', function (Blueprint $table) {
            $table->dropForeign('conges_employe_id_foreign');
        });
        Schema::drop('conges');
        Schema::drop('type_conge');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('conges', function (Blueprint $table) {
            $table->dropForeign('conges_type_conge_id_foreign');
        });
        Schema::table('conges', function (Blueprint $table) {
            $table->dropForeign('conges_employe_id_foreign');
        });
        Schema::drop('conges');
        Schema::drop('type_conge');
        Schema::enableForeignKeyConstraints();
    }
};
