@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold mb-4">EQUITY UP</h1>
                <p class="text-xl text-blue-100">Sistem Manajemen dan Monitoring Perangkat Terpadu</p>
            </div>

            <!-- Card Status Keseluruhan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status Card -->
                <div class="bg-white text-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">Status Perangkat Keseluruhan</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="border-r-2 border-gray-200">
                            <div class="text-4xl font-bold text-green-600">{{ $totalNormal }}</div>
                            <p class="text-gray-600 mt-2">Perangkat Normal</p>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-red-600">{{ $totalBroken }}</div>
                            <p class="text-gray-600 mt-2">Rusak/Offline</p>
                        </div>
                    </div>
                </div>

                <!-- Information Card -->
                <div class="bg-white text-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">Tentang Sistem</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-bold text-lg text-blue-600">AQUAVISKA</h3>
                            <p class="text-gray-600 text-sm">Sistem monitoring kualitas air terpadu dengan sensor real-time</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-purple-600">IOT Climate</h3>
                            <p class="text-gray-600 text-sm">Sistem monitoring iklim dan lingkungan berbasis Internet of Things</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Ringkasan Per Lokasi</h2>

            @if($locations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($locations as $location)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <!-- Location Header -->
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-t-lg">
                                <h3 class="text-xl font-bold">{{ $location->name }}</h3>
                                <p class="text-blue-100 text-sm mt-2">{{ $location->description ?? 'Lokasi terdaftar' }}</p>
                            </div>

                            <!-- Location Content -->
                            <div class="p-6">
                                <!-- Equipment List -->
                                <div class="space-y-3 mb-6">
                                    @forelse($location->equipment as $equip)
                                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-900">{{ $equip->name }}</p>
                                                <p class="text-sm text-gray-500">{{ str_replace('_', ' ', $equip->type) }}</p>
                                            </div>
                                            <!-- Status Badge -->
                                            <span class="ml-2 px-3 py-1 rounded-full text-xs font-bold
                                                @if($equip->status === 'normal') bg-green-100 text-green-800
                                                @elseif($equip->status === 'warning') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif
                                            ">
                                                {{ $equip->getStatusLabel() }}
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 text-center py-4">Tidak ada perangkat</p>
                                    @endforelse
                                </div>

                                <!-- Statistics -->
                                <div class="grid grid-cols-2 gap-4 mb-6 py-4 border-t border-gray-200">
                                    <div>
                                        <p class="text-2xl font-bold text-green-600">{{ $location->getNormalEquipmentCount() }}</p>
                                        <p class="text-xs text-gray-600">Normal</p>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-red-600">{{ $location->getBrokenEquipmentCount() }}</p>
                                        <p class="text-xs text-gray-600">Tidak Normal</p>
                                    </div>
                                </div>

                                <!-- Detail Button -->
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-gray-500 text-lg">Belum ada lokasi terdaftar</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Statistik Singkat Section -->
    <section class="bg-white py-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-12">Statistik Singkat</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Total Perangkat Aktif -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-6">
                        <p class="text-gray-600 text-sm font-medium">Total Perangkat Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalActiveDevices }}</p>
                    </div>
                </div>

                <!-- Total Lokasi Terdaftar -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-6">
                        <p class="text-gray-600 text-sm font-medium">Total Lokasi Terdaftar</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalLocations }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
