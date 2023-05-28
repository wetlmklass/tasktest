<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Balance::factory(200)->create();

        /*\App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
        ]);*/
    }
}
