<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FrequenceSolde_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frequences_solde')->insert([

            [
                'frequence' => 'Mensuelle',

            ],
            [
                'frequence' => 'Trimestrielle',

            ],
            [
                'frequence' => 'Semestrielle',

            ],
            [
                'frequence' => 'Annuelle',
            ],
            [
                'frequence' => 'Unique',
            ],

        ]);

    }
}
