<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conges')->insert([
            [
                'type_conge_id' => 1,
                'employe_id' => 1,
                'debut' => '2020-01-01 08:00:00',
                'fin' => '2020-01-01 17:00:00',
                'intervale' => '0 days 09 hours 0 minutes  0 seconds',
                'duree_conge' => 1440,
                'motif'=> "Besoin d'un pause sur mes congé payé",
                'etat_conge_id' => 3,
                'cumul_perso' => '30 days',
                'j_utilise' => 1,
                'restant' => '30 days',
            ],
            [
                'type_conge_id' => 1,
                'employe_id' => 1,
                'debut' => '2022-01-01 08:00:00',
                'fin' => '2022-01-03 17:00:00',
                'intervale' => '02 days 09 hours',
                'duree_conge' => 2880,
                'motif'=> "premier congé payé",
                'etat_conge_id' => 1,
                'cumul_perso' => '30 days',
                'j_utilise' => 3,
                'restant' => '28 days',
            ],
            [
                'type_conge_id' => 1,
                'employe_id' => 1,
                'debut' => '2022-01-01 00:00:00',
                'fin' => '2022-01-03 19:00:00',
                'intervale' => '02 days 19 hours',
                'duree_conge' => 0,
                'motif'=> "j'ai la flemme",
                'etat_conge_id' => 2,
                'cumul_perso' => '32 days 12 hours',
                'j_utilise' => 0,
                'restant' => '32 days 12 hours',
            ]
        ]);
    }
}
