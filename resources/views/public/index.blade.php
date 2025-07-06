<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Foto Publik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a class="font-bold text-xl" href="{{ route('public.index') }}">Galeri Foto</a>
            <div>
                @auth
                    <a href="{{ route('albums.index') }}" class="text-gray-700 hover:text-blue-500">Dasbor Saya</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Album Publik</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($albums as $album)
                <a href="{{ route('public.album.show', $album) }}" class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-4">
                        <h2 class="text-xl font-bold text-gray-900">{{ $album->name }}</h2>
                        <p class="text-sm text-gray-600 mt-1">oleh: {{ $album->user->name }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $album->photos_count }} foto</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-gray-500">Belum ada album publik yang tersedia.</p>
            @endforelse
        </div>
    </div>
</body>
</html>