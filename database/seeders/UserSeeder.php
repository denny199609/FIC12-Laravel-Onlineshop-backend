<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(9)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin Denny',
            'email' => 'admin@denny.com',
            'password' => Hash::make('123456'),
            'phone' => '08123456789',
            'roles' => 'admin',
        ]);
    }
}
