<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        // Kategorileri oluştur
        $categories = [
            'Soğuk İçecekler',
            'Sıcak İçecekler',
            'Tatlılar'
        ];

        foreach ($categories as $category) {
            Category::create([
                'user_id' => $user->id,
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => null,
            ]);
        }
    }
}
