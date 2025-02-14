<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kafeler')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('head')
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="{{ url('/') }}" class="text-xl font-bold">Kafeler</a>
            <a href="{{ url('/admin/register') }}">Kayıt Ol</a>
        </div>
    </header>

    <div class="container mx-auto p-8">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Kafeler. Tüm Haklar Saklıdır.</p>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>
