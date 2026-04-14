@extends('layouts.app')

@section('title', $location->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <section class="bg-white border-b border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('locations.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-flex items-center gap-1">
                <span>←</span> Kembali ke Daftar Lokasi
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $location->name }}</h1>
            <p class="text-gray-600">{{ $location->description ?? 'Detail lokasi dan perangkatnya' }}</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Location Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Perangkat</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $location->equipment->count() }}</p>
                        </div>
                        <svg class="h-12 w-12 text-blue-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Perangkat Normal</p>
                            <p class="text-3xl font-bold text-green-600">{{ $location->getNormalEquipmentCount() }}</p>
                        </div>
                        <svg class="h-12 w-12 text-green-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Perangkat Tidak Normal</p>
                            <p class="text-3xl font-bold text-red-600">{{ $location->getBrokenEquipmentCount() }}</p>
                        </div>
                        <svg class="h-12 w-12 text-red-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Equipment List -->
            @if($location->equipment->count() > 0)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-bold text-gray-900">Daftar Perangkat</h2>
                    </div>
                    
                    <div class="divide-y">
                        @foreach($location->equipment as $equip)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-4 mb-2">
                                            <h3 class="text-lg font-bold text-gray-900">{{ $equip->name }}</h3>
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $equip->type === 'AQUAVISKA' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                                                {{ str_replace('_', ' ', $equip->type) }}
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm">{{ $equip->description }}</p>
                                    </div>
                                    <span class="px-4 py-2 rounded-full text-sm font-bold
                                        @if($equip->status === 'normal') bg-green-100 text-green-800
                                        @elseif($equip->status === 'warning') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif
                                    ">
                                        {{ $equip->getStatusLabel() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-gray-500 text-lg">Tidak ada perangkat di lokasi ini</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
