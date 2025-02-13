<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
            $imagePath = $this->generateFakeImage();

            Category::create([
                'user_id' => $user->id,
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => $imagePath,
            ]);
        }
    }

    private function generateFakeImage(): string
    {
        $imageUrl = 'https://picsum.photos/400/300';
        $contents = file_get_contents($imageUrl);

        $imageName = Str::random(10) . '.jpg';
        Storage::disk('public')->put($imageName, $contents);

        return $imageName;
    }
}
