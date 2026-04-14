@extends('layouts.app')

@section('title', 'Lokasi & Perangkat')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <section class="bg-white border-b border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Lokasi & Perangkat</h1>
            <p class="text-gray-600">Pantau status dan performa semua perangkat monitoring Anda</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter & Search Bar -->
            <div class="mb-8">
                <!-- Type Filter Buttons -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('equipment.index', array_merge(request()->query(), ['type' => 'all'])) }}" 
                       class="px-4 py-2 rounded-full font-medium transition-all {{ $type === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Semua
                    </a>
                    <a href="{{ route('equipment.index', array_merge(request()->query(), ['type' => 'AQUAVISKA'])) }}" 
                       class="px-4 py-2 rounded-full font-medium transition-all flex items-center gap-2 {{ $type === 'AQUAVISKA' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                        AQUAVISKA
                    </a>
                    <a href="{{ route('equipment.index', array_merge(request()->query(), ['type' => 'IOT_CLIMATE'])) }}" 
                       class="px-4 py-2 rounded-full font-medium transition-all flex items-center gap-2 {{ $type === 'IOT_CLIMATE' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        <span class="inline-block w-3 h-3 bg-orange-500 rounded-full"></span>
                        IOT CLIMATE
                    </a>
                </div>

                <!-- Search & Sort Bar -->
                <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
                    <!-- Search Box -->
                    <form method="GET" class="w-full md:w-96">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari perangkat..." 
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
                        <input type="hidden" name="type" value="{{ $type }}">
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

            <!-- Equipment Grid -->
            @if($equipment->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($equipment as $item)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden group cursor-pointer">
                            <!-- Card Image/Header -->
                            <div class="relative h-40 bg-gradient-to-br {{ $item->type === 'AQUAVISKA' ? 'from-blue-400 to-blue-600' : 'from-orange-400 to-orange-600' }} overflow-hidden flex items-center justify-center">
                                @if($item->type === 'AQUAVISKA')
                                    <svg class="h-20 w-20 text-blue-200 opacity-40" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                @else
                                    <svg class="h-20 w-20 text-orange-200 opacity-40" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011-1h8a1 1 0 011 1v14a1 1 0 01-1 1H6a1 1 0 01-1-1V2zm12-1a2 2 0 012 2v12a2 2 0 01-2 2h-2.5a1 1 0 00-1 1h-5a1 1 0 00-1-1H2a2 2 0 01-2-2V3a2 2 0 012-2h12z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Card Content -->
                            <div class="p-4">
                                <!-- Type Badge -->
                                <div class="flex gap-2 mb-3">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $item->type === 'AQUAVISKA' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                                        <span class="inline-block w-2 h-2 rounded-full {{ $item->type === 'AQUAVISKA' ? 'bg-blue-500' : 'bg-orange-500' }}"></span>
                                        {{ str_replace('_', ' ', $item->type) }}
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="font-bold text-lg text-gray-900 mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    {{ $item->name }}
                                </h3>

                                <!-- Location -->
                                <p class="text-sm text-gray-600 mb-4">
                                    📍 {{ $item->location->name }}
                                </p>

                                <!-- Status Badge -->
                                <div class="flex items-center justify-between py-3 border-t border-gray-200 mt-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        @if($item->status === 'normal') bg-green-100 text-green-800
                                        @elseif($item->status === 'warning') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif
                                    ">
                                        {{ $item->getStatusLabel() }}
                                    </span>
                                    <span class="text-xs text-gray-600">
                                        @if($item->type === 'AQUAVISKA')
                                            85.7 NTU
                                        @else
                                            28.5°C
                                        @endif
                                    </span>
                                </div>

                                <!-- View Detail Button -->
                                <a href="{{ route('equipment.show', $item) }}" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors mt-4">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $equipment->appends(request()->query())->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10a4 4 0 018 0m-7 4h.01M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Tidak ada perangkat yang ditemukan</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
