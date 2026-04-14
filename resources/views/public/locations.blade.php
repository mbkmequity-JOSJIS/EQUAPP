@extends('layouts.app')

@section('content')
<div>
    <div class="flex justify-between items-center flex-wrap gap-3">
        <h1 class="text-2xl font-bold">📍 Lokasi & Perangkat</h1>
        <div class="space-x-2">
            <a href="?filter=semua" class="px-4 py-2 rounded-lg {{ $filter == 'semua' ? 'bg-green-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">Semua</a>
            <a href="?filter=AQUAVISKA" class="px-4 py-2 rounded-lg {{ $filter == 'AQUAVISKA' ? 'bg-green-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">AQUAVISKA</a>
            <a href="?filter=IOT Climate" class="px-4 py-2 rounded-lg {{ $filter == 'IOT Climate' ? 'bg-green-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">IOT Climate</a>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-5 mt-6">
        @forelse($locations as $loc)
        <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">
            <!-- Gambar Lokasi -->
            <img src="{{ $loc->gambar }}" alt="{{ $loc->nama }}" class="w-full h-44 object-cover">
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-xl">{{ $loc->nama }}</h3>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                            <p class="text-sm text-gray-500">{{ $loc->alamat }}</p>
                        </div>
                        <span class="inline-block mt-2 text-xs bg-gray-100 px-2 py-0.5 rounded">{{ $loc->tipe }}</span>
                    </div>
                    <div class="text-right">
                        <span class="status-badge 
                            @if($loc->status == 'Normal') status-normal 
                            @elseif($loc->status == 'Waspada') status-waspada 
                            @else status-rusak @endif">
                            {{ $loc->status }}
                        </span>
                        @if(!$loc->isResponsive)
                        <div class="mt-1 text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded">⚠️ Alat Tidak Merespons</div>
                        @endif
                    </div>
                </div>
                <a href="{{ route('public.location.detail', $loc->id) }}" class="inline-block mt-4 text-green-600 font-medium hover:underline">Lihat Detail →</a>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 py-10">Tidak ada perangkat ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection