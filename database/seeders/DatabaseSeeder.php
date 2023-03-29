<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            "is_admin" => true
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'password' => 'password',
            'email' => 'test1@example.com',
        ]);
        \App\Models\Listing::factory(20)->create(["by_user_id" => 1]);
        \App\Models\Listing::factory(20)->create(["by_user_id" => 2]);
    }
}
