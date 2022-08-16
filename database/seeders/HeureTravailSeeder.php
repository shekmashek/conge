<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HeureTravailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heures_de_travail')->insert([
            [
                'designation' => 'Heures de jour',
                'heure_debut' => '08:00:00',
                'heure_fin' => '17:00:00',
                'debut_pause' => '12:00:00',
                'fin_pause' => '13:00:00',
            ],
            [
                'designation' => 'Heures de nuit',
                'heure_debut' => '20:00:00',
                'heure_fin' => '05:00:00',
                'debut_pause' => '00:00:00',
                'fin_pause' => '01:00:00',
            ],
        ]);
    }
}
