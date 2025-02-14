@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($users as $user)
        <a href="{{ route('cafe.index', $user->user_name) }}" class="aspect-square bg-gray-200 rounded-lg overflow-hidden items-center justify-center flex">
            {{ $user->user_name }}
        </a>
        @endforeach
    </div>
@endsection
