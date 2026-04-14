@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-2">👨‍💻 Profil Pengembang</h1>
    <p class="text-gray-500 mb-6">Tim di balik EQUITY UP - Sistem Monitoring Lingkungan Terintegrasi</p>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($team as $member)
        <div class="bg-white rounded-xl shadow p-4 text-center">
            <img src="{{ $member['foto'] }}" alt="{{ $member['nama'] }}" class="w-24 h-24 rounded-full mx-auto border-2 border-green-500">
            <h3 class="font-bold mt-3">{{ $member['nama'] }}</h3>
            <p class="text-sm text-gray-500">{{ $member['role'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold">📚 Program MBKM</h2>
        <p class="mt-2"><strong>Merdeka Belajar Kampus Merdeka (MBKM)</strong> - Program ini merupakan bagian dari proyek independen yang didanai dan didukung oleh Kampus Merdeka.</p>
        <p class="mt-2"><strong>Institusi / Mitra:</strong> Universitas Gadjah Mada & Dinas Lingkungan Hidup</p>
        <p><strong>Periode Pelaksanaan:</strong> Agustus 2025 - Februari 2026</p>
        <p class="mt-3 text-sm text-gray-600">Proyek EQUITY UP mengintegrasikan sensor AQUAVISKA dan IoT Climate untuk pemantauan lingkungan real-time, sebagai bentuk kontribusi nyata dalam program MBKM.</p>
    </div>
</div>
@endsection