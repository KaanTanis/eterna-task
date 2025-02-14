@extends('layouts.app')

@section('title', $user->user_name . ' Kafesi - ' . $product->name)

@section('content')
    <div class="container mx-auto p-4">
        <!-- Kafeye ait başlık -->
        <h1 class="font-bold text-2xl mb-6">{{ $user->user_name }} Kafesi - {{ $product->name }}</h1>

        <!-- Ürün Detayları -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Ürün Görseli -->
            <div>
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
            </div>
            <!-- Ürün Bilgileri -->
            <div>
                <h2 class="font-bold text-xl mb-2">{{ $product->name }}</h2>
                <p class="text-gray-500 text-sm mb-4">{{ $product->description }}</p>
                <span class="text-xl font-bold text-blue-600">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                
                <!-- Kategori Bağlantısı -->
                <div class="mt-4">
                    <span class="text-gray-700 font-semibold">Kategori:</span>
                    <a href="{{ route('cafe.category', ['username' => $user->user_name, 'category' => $category->slug]) }}" class="text-blue-600 hover:underline">
                        {{ $category->name }}
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Kategoriye ait diğer ürünler kısmı -->
        <h3 class="font-bold text-xl mt-8 mb-4">Bu Kategorideki Diğer Ürünler</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($category->products as $otherProduct)
                <a href="{{ route('product.show', [
                    'username' => $user->user_name,
                    'category' => $category->slug,
                    'product' => $otherProduct->slug
                ]) }}" class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 duration-300">
                    <img src="{{ Storage::url($otherProduct->image) }}" alt="{{ $otherProduct->name }}" class="object-cover w-full h-48">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">{{ $otherProduct->name }}</h3>
                        <span class="text-xl font-bold text-blue-600">{{ number_format($otherProduct->price, 2, ',', '.') }} ₺</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
