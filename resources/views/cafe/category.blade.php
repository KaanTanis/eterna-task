@extends('layouts.app')

@section('title', $user->user_name . ' Kafesi - ' . $category->name)

@section('content')
    <h1 class="font-bold text-2xl mb-8">{{ $user->user_name }} Kafesi - {{ $category->name }}</h1>

    <!-- Kategori Görseli -->
    <div class="bg-gray-200 rounded-lg overflow-hidden relative mb-6">
        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="object-cover w-full h-64">
        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-center py-2">
            <span class="font-bold text-xl">{{ $category->name }}</span>
        </div>
    </div>

    <!-- Ürünler -->
    <h2 class="font-bold text-xl mb-4">Ürünler</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($products as $product)
        <a href="{{ route('product.show', [
            'username' => $user->user_name,
            'category' => $category->slug,
            'product' => $product->slug
        ]) }}" class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 duration-300">
            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-48">
            <div class="p-4">
                <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-500 text-sm mb-2">{{ $product->description }}</p>
                <span class="text-xl font-bold text-blue-600">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
            </div>
        </a>
        @endforeach
    </div>
@endsection
