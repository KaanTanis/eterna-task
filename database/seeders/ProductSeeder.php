<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                $product = Product::create([
                    'user_id' => $user->id,
                    'name' => $productName,
                    'slug' => Str::slug($productName),
                    'price' => rand(10, 50),
                    'description' => 'Lezzetli ' . strtolower($productName),
                    'image' => null,
                ]);

                $product->categories()->attach($category->id);
            }
        }
    }
}
