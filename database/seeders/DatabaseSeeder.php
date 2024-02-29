<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //category
        \App\Models\Category::factory(5)->create();
        //product
        \App\Models\Product::factory(20)->create();

        $this->call(
            UserSeeder::class,
        );

        //address
        \App\Models\Address::factory(10)->create();
    }
}
