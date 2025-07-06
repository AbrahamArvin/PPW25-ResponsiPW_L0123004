<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $album->name }} - Galeri Foto</title>
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
        <h1 class="text-3xl font-bold text-gray-800">{{ $album->name }}</h1>
        <p class="text-gray-600 mt-1">oleh: {{ $album->user->name }}</p>
        <p class="text-gray-700 mt-2">{{ $album->description }}</p>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($album->photos as $photo)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="font-bold truncate">{{ $photo->title }}</h5>
                        <p class="text-sm text-gray-600 truncate">{{ $photo->description }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Album ini tidak memiliki foto.</p>
            @endforelse
        </div>
    </div>
</body>
</html>