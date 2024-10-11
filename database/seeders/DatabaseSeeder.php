<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Company;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            'firstname' => 'Kieffer',
            'lastname' => 'Navarro',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'type' => 'Editor',
            'status' => 'Active',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        Company::factory()->count(3)->create();
        User::factory()->count(3)->create();
        Article::factory()->count(10)->create();
    }
}
