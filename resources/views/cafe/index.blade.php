@extends('layouts.app')

@section('title', $user->user_name . ' Kafesi')

@section('content')
    <h1 class="font-bold text-2xl mb-8">{{ $user->user_name }} Kafesi</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($categories as $category)
        <div class="bg-gray-200 rounded-lg overflow-hidden items-center justify-center flex aspect-square relative hover:scale-105 duration-300">
            <img src="{{ Storage::url($category->image) }}" alt="" class="object-cover w-full h-full">
            <a href="{{ route('cafe.category', ['username' => $user->user_name, 'category' => $category->slug]) }}" class="absolute inset-0 flex justify-center items-center text-white font-bold text-xl">
                {{ $category->name }}
            </a>
        </div>
        @endforeach
    </div>
@endsection
