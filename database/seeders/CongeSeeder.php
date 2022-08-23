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
                'intervalle' => '0 days 09 hours 0 minutes  0 seconds',
                'duree_conge' => 1440,
                'motif'=> "Besoin d'un pause sur mes congé payé",
                'etat_conge_id' => 3,
                'cumul_perso' => '30 days',
                'j_utilise' => null,
                'restant' => '30 days',
            ],
            [
                'type_conge_id' => 1,
                'employe_id' => 1,
                'debut' => '2020-03-01 08:00:00',
                'fin' => '2020-03-03 17:00:00',
                'intervalle' => '1 days 08 hours 0 minutes  0 seconds',
                'duree_conge' => 3420,
                'motif'=> "Congé payé validé",
                'etat_conge_id' => 3,
                'cumul_perso' => '30 days',
                'j_utilise' => 2,
                'restant' => '28 days',
            ],
            [
                'type_conge_id' => 2,
                'employe_id' => 2,
                'debut' => '2022-01-01 08:00:00',
                'fin' => '2022-01-03 17:00:00',
                'intervalle' => '01 days 08 hours',
                'duree_conge' => 3420,
                'motif'=> "premier congé Exceptionnel",
                'etat_conge_id' => 1,
                'cumul_perso' => '30 days',
                'j_utilise' => 2,
                'restant' => '28 days',
            ],
            [
                'type_conge_id' => 8,
                'employe_id' => 5,
                'debut' => '2022-01-12 08:00:00',
                'fin' => '2022-01-12 12:00:00',
                'intervalle' => '04 hours',
                'duree_conge' => 240,
                'motif'=> "Permission",
                'etat_conge_id' => 1,
                'cumul_perso' => '40 days',
                'j_utilise' => 0.5,
                'restant' => '39.5 days',
            ],
            [
                'type_conge_id' => 3,
                'employe_id' => 5,
                'debut' => '2022-02-01 08:00:00',
                'fin' => '2022-03-10 17:00:00',
                'intervalle' => '1 months 09 days 08 hours',
                'duree_conge' => 13500,
                'motif'=> "congé maladie",
                'etat_conge_id' => 3,
                'cumul_perso' => '37 days',
                'j_utilise' => null,
                'restant' => '37 days',
            ],
            [
                'type_conge_id' => 6,
                'employe_id' => 1,
                'debut' => '2022-04-18 00:00:00',
                'fin' => '2022-04-22 19:00:00',
                'intervalle' => '05 days',
                'duree_conge' => 7200,
                'motif'=> "congé de formation",
                'etat_conge_id' => 1,
                'cumul_perso' => '42 days 12 hours',
                'j_utilise' => 5,
                'restant' => '37 days 12 hours',
            ]
        ]);
    }
}
