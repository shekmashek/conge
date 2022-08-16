<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\HeureTravailSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(FrequenceSolde_seeder::class);
        // $this->call(TypeCongeSeeder::class);
        // $this->call(EtatCongeSeeder::class);
        // $this->call(CongeSeeder::class);
        $this->call(HeureTravailSeeder::class);
    }
}
