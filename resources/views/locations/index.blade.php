@extends('layouts.app')

@section('title', 'Lokasi & Perangkat')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <section class="bg-white border-b border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Lokasi & Perangkat</h1>
            <p class="text-gray-600">Kelola dan pantau semua lokasi terdaftar dalam sistem</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter & Search Bar -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
                    <!-- Search Box -->
                    <form method="GET" class="w-full md:w-96">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari lokasi..." 
                                value="{{ request('search') }}"
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </form>

                    <!-- Sort Dropdown -->
                    <form method="GET" class="flex items-center gap-2">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <label class="text-gray-700 font-medium">Urutkan:</label>
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="name_desc" {{ $sort === 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Locations Grid -->
            @if($locations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($locations as $location)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden group cursor-pointer">
                            <!-- Card Image/Header -->
                            <div class="relative h-40 bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="h-20 w-20 text-blue-300 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-4">
                                <!-- Title -->
                                <h3 class="font-bold text-lg text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                                    {{ $location->name }}
                                </h3>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    {{ $location->description ?? 'Lokasi terdaftar' }}
                                </p>

                                <!-- Stats -->
                                <div class="flex gap-3 mb-4 py-3 border-t border-gray-200">
                                    <div class="flex-1 text-center">
                                        <p class="text-lg font-bold text-green-600">{{ $location->getNormalEquipmentCount() }}</p>
                                        <p class="text-xs text-gray-600">Normal</p>
                                    </div>
                                    <div class="flex-1 text-center border-l border-gray-200">
                                        <p class="text-lg font-bold text-red-600">{{ $location->getBrokenEquipmentCount() }}</p>
                                        <p class="text-xs text-gray-600">Tidak Normal</p>
                                    </div>
                                </div>

                                <!-- View Detail Button -->
                                <a href="{{ route('locations.show', $location) }}" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $locations->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10a4 4 0 018 0m-7 4h.01M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Tidak ada lokasi yang ditemukan</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
