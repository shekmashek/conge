<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeCongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_conge')->insert([

            [
                'type_conge' => 'Congé payé',
                'couleur' => '#14cdc8',
                'max_duration' => '',
                'duree_max' => null,
                'solde_format' => '2 days 12 hours',
                'solde' => 3600,
                'frequence_solde_id' => 1,
                'paye' => 1
            ],
            [
                'type_conge' => 'Congé exceptionnel',
                'couleur' => '#dadfe1',
                'max_duration' => '4 days',
                'duree_max' => 5760,
                'solde_format' => '10 days',
                'solde' => 14400,
                'frequence_solde_id' => 4,
                'paye' => 1
            ],
            [
                'type_conge' => 'Congé maladie',
                'couleur' => '#fcd670',
                'max_duration' => '6 months',
                'duree_max' => 262980,
                'solde_format' => '2 days 12 hours',
                'solde' => null,
                'frequence_solde_id' => 5,
                'paye' => 1
            ],
            [
                'type_conge' => 'Congé de maternité',
                'couleur' => '#fbe7ef',
                'max_duration' => '14 weeks',
                'duree_max' => 2157120,
                'solde_format' => '',
                'solde' => null,
                'frequence_solde_id' => 5,
                'paye' => 1
            ],
            [
                'type_conge' => 'Congé assistance enfant malade',
                'couleur' => '#fbe7ef',
                'max_duration' => '6 months',
                'duree_max' => 262980,
                'solde_format' => '',
                'solde' => null,
                'frequence_solde_id' => 5,
                'paye' => 1
            ],
            [
                'type_conge' => 'Congé éducation',
                'couleur' => '#038aff',
                'max_duration' => '12 days',
                'duree_max' => 17280,
                'solde_format' => '',
                'solde' => null,
                'frequence_solde_id' => 5,
                'paye' => 1
            ],
            [
                'type_conge' => 'Congé impayés',
                'couleur' => '#f27935',
                'max_duration' => '',
                'duree_max' => null,
                'solde_format' => '',
                'solde' => null,
                'frequence_solde_id' => 5,
                'paye' => 0
            ],
            [
                'type_conge' => 'Irrégulier',
                'couleur' => '#f22613',
                'max_duration' => '',
                'duree_max' => null,
                'solde_format' => '',
                'solde' => null,
                'frequence_solde_id' => 5,
                'paye' => 0
            ],


         ]);
    }
}
