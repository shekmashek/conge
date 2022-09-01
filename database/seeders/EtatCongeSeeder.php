<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EtatCongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conges_etats_conge')->insert([

            [
                'etat_conge' => 'Validé',
            ],
            [
                'etat_conge' => 'Refusé',
            ],
            [
                'etat_conge' => 'En attente',
            ],
            [
                'etat_conge' => 'Annulé',
            ],

        ]);
    }
}
