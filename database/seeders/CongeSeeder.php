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
                'j_utilise' => 0,
                'restant' => '30 days',
            ],
            [
                'type_conge_id' => 1,
                'employe_id' => 1,
                'debut' => '2020-03-01 08:00:00',
                'fin' => '2020-03-03 17:00:00',
                'intervale' => '2 days 09 hours 0 minutes  0 seconds',
                'duree_conge' => 3420,
                'motif'=> "Congé payé",
                'etat_conge_id' => 3,
                'cumul_perso' => '30 days',
                'j_utilise' => 0,
                'restant' => '30 days',
            ],
            [
                'type_conge_id' => 1,
                'employe_id' => 2,
                'debut' => '2022-01-01 08:00:00',
                'fin' => '2022-01-03 17:00:00',
                'intervale' => '02 days 09 hours',
                'duree_conge' => 3420,
                'motif'=> "premier congé payé",
                'etat_conge_id' => 1,
                'cumul_perso' => '30 days',
                'j_utilise' => 3,
                'restant' => '27 days',
            ],
            [
                'type_conge_id' => 3,
                'employe_id' => 5,
                'debut' => '2022-02-01 08:00:00',
                'fin' => '2022-02-10 17:00:00',
                'intervale' => '09 days 09 hours',
                'duree_conge' => 13500,
                'motif'=> "congé maladie",
                'etat_conge_id' => 1,
                'cumul_perso' => '35 days',
                'j_utilise' => 9,
                'restant' => '26 days',
            ],
            [
                'type_conge_id' => 2,
                'employe_id' => 1,
                'debut' => '2022-01-01 00:00:00',
                'fin' => '2022-01-03 19:00:00',
                'intervale' => '02 days 19 hours',
                'duree_conge' => 4020,
                'motif'=> "Exceptionnelement j'ai la flemme",
                'etat_conge_id' => 2,
                'cumul_perso' => '32 days 12 hours',
                'j_utilise' => 0,
                'restant' => '32 days 12 hours',
            ]
        ]);
    }
}
