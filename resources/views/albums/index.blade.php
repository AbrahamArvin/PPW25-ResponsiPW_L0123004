<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Album Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Buat Album Baru
                    </a>

                    @if (session('success'))
                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($albums as $album)
                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                    <h3 class="font-bold text-lg">{{ $album->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $album->description }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div>
                                            <a href="{{ route('albums.show', $album) }}" class="text-blue-500 hover:underline">Lihat Foto ({{ $album->photos_count }})</a>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('albums.edit', $album) }}" class="text-yellow-500 hover:underline">Edit</a>
                                            <form action="{{ route('albums.destroy', $album) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Anda belum memiliki album.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>