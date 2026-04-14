@extends('layouts.app')

@section('title', $equipment->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <section class="bg-white border-b border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('equipment.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-flex items-center gap-1">
                <span>←</span> Kembali ke Daftar Perangkat
            </a>
            <div class="flex items-center gap-4">
                <h1 class="text-4xl font-bold text-gray-900">{{ $equipment->name }}</h1>
                <span class="px-4 py-2 rounded-full text-sm font-bold
                    @if($equipment->status === 'normal') bg-green-100 text-green-800
                    @elseif($equipment->status === 'warning') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif
                ">
                    {{ $equipment->getStatusLabel() }}
                </span>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2">
                    <!-- Basic Info Card -->
                    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Perangkat</h2>
                        
                        <div class="space-y-4">
                            <div class="pb-4 border-b border-gray-200">
                                <p class="text-sm text-gray-600 font-medium mb-1">Nama Perangkat</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $equipment->name }}</p>
                            </div>

                            <div class="pb-4 border-b border-gray-200">
                                <p class="text-sm text-gray-600 font-medium mb-1">Tipe Perangkat</p>
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-bold {{ $equipment->type === 'AQUAVISKA' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                                    <span class="inline-block w-2 h-2 rounded-full {{ $equipment->type === 'AQUAVISKA' ? 'bg-blue-500' : 'bg-orange-500' }}"></span>
                                    {{ str_replace('_', ' ', $equipment->type) }}
                                </span>
                            </div>

                            <div class="pb-4 border-b border-gray-200">
                                <p class="text-sm text-gray-600 font-medium mb-1">Status</p>
                                <span class="px-3 py-1 rounded-full text-sm font-bold
                                    @if($equipment->status === 'normal') bg-green-100 text-green-800
                                    @elseif($equipment->status === 'warning') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ $equipment->getStatusLabel() }}
                                </span>
                            </div>

                            <div class="pb-4 border-b border-gray-200">
                                <p class="text-sm text-gray-600 font-medium mb-1">Lokasi</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    <a href="{{ route('locations.show', $equipment->location) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $equipment->location->name }} →
                                    </a>
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 font-medium mb-1">Deskripsi</p>
                                <p class="text-gray-700">{{ $equipment->description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sensor Data Card -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Sensor Real-time</h2>
                        
                        @if($equipment->type === 'AQUAVISKA')
                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg">
                                    <p class="text-gray-600 text-sm mb-2">Kekeruhan (Turbidity)</p>
                                    <p class="text-4xl font-bold text-blue-600">85.7</p>
                                    <p class="text-xs text-gray-600 mt-2">NTU</p>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-lg">
                                    <p class="text-gray-600 text-sm mb-2">pH Level</p>
                                    <p class="text-4xl font-bold text-green-600">7.2</p>
                                    <p class="text-xs text-gray-600 mt-2">pH</p>
                                </div>
                            </div>
                        @else
                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center p-6 bg-gradient-to-br from-red-50 to-red-100 rounded-lg">
                                    <p class="text-gray-600 text-sm mb-2">Suhu</p>
                                    <p class="text-4xl font-bold text-red-600">28.5</p>
                                    <p class="text-xs text-gray-600 mt-2">°C</p>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg">
                                    <p class="text-gray-600 text-sm mb-2">Kelembaban</p>
                                    <p class="text-4xl font-bold text-purple-600">72</p>
                                    <p class="text-xs text-gray-600 mt-2">%</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Quick Info Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">ID Perangkat</span>
                                <span class="font-semibold text-gray-900">#{{ $equipment->id }}</span>
                            </div>

                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">Dibuat</span>
                                <span class="font-semibold text-gray-900">{{ $equipment->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Terakhir Update</span>
                                <span class="font-semibold text-gray-900">{{ $equipment->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <button class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                            Kelola Perangkat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
