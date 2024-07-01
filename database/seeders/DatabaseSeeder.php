<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Activities;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Naimul Islam',
             'email' => 'naimul@gmail.com',
             'is_admin' => true,
             'password' => bcrypt ("naimul0000")
         ]);
//        Product::factory (20)->create ();
//        Activities::factory (5)->create ();
    }
}
