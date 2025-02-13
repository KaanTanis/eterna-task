<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        $products = [
            'Soğuk İçecekler' => ['Kola', 'Fanta', 'Sprite', 'Ayran', 'Soda'],
            'Sıcak İçecekler' => ['Çay', 'Kahve', 'Latte', 'Espresso', 'Salep'],
            'Tatlılar' => ['Baklava', 'Sütlaç', 'Kazandibi', 'Künefe', 'Profiterol']
        ];

        foreach ($categories as $category) {
            foreach ($products[$category->name] as $productName) {
                $imagePath = $this->generateFakeImage();

                $product = Product::create([
                    'user_id' => $user->id,
                    'name' => $productName,
                    'slug' => Str::slug($productName),
                    'price' => rand(10, 50),
                    'description' => 'Lezzetli ' . strtolower($productName),
                    'image' => $imagePath,
                ]);

                $product->categories()->attach($category->id);
            }
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
