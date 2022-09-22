<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        // // $this->call(CongeSeeder::class);
        // $this->call(HeureTravailSeeder::class);
        // DB::table('users')->insert([
        //     'name' => 'zaka',
        //     'email' => 'zaka@gmail.com',
        //     'password' => Hash::make('0000')
        // ]);

        DB::table('users')->insert([
            'name' => 'soa',
            'email' => 'soa@gmail.com',
            'telephone' => '0343403438',
            'cin' => '101251100320',
            'password' => Hash::make('0000')
        ]);
    }
}
