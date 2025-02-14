<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'test@example.com',
            'password'=> bcrypt('12345678'),
            'user_name' => 'TestUser',
        ]);

        User::factory()->create([
            'name' => 'Test2',
            'surname' => 'User2',
            'email' => 'test2@example.com',
            'password'=> bcrypt('12345678'),
            'user_name' => 'TestUser2',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
