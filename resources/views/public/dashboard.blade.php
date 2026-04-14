@extends('layouts.app')

@section('content')
<div class="space-y-0">
    <!-- HERO SECTION - FULL PAGE DESKTOP (Bootstrap style) -->
    <section class="position-relative overflow-hidden rounded-4 mb-4">
        <div id="heroSection" class="position-relative w-100" style="--hero-height: 90vh; min-height: 60vh; height: calc(var(--hero-height)); max-height: 1200px;">
            <img src="{{ asset('images/heroes/hero-background.png') }}"
                 alt="EQUITY UP Hero Background"
                 class="img-fluid w-100 h-100 object-cover object-center">
            <div class="position-absolute top-0 start-0 end-0 bottom-0 bg-dark opacity-50"></div>
            <div class="position-absolute bottom-0 start-0 end-0" style="height: 10rem; background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(248,250,252,1) 100%);"></div>

            <div class="position-absolute bottom-3 start-50 translate-middle-x z-2 text-center text-white">
                <div class="border border-white border-2 rounded-pill d-inline-flex align-items-center justify-content-center" style="width: 2rem; height: 3rem;">
                    <div class="bg-white rounded-pill" style="width: 0.25rem; height: 0.75rem;"></div>
                </div>
                <p class="mt-2 small text-white-50 mb-0">Scroll ke bawah</p>
            </div>
        </div>
    </section>

    <!-- KONTEN SETELAH HERO SECTION -->
    <div class="container-fluid px-4 py-5 bg-white rounded-4 shadow-sm">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-xl-8">
                <div class="d-flex justify-content-center mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3">
                        <i class="fas fa-water fs-3"></i>
                    </div>
                </div>
                <h1 class="display-5 fw-bold text-dark mb-3">EQUITY UP</h1>
                <p class="fs-5 text-success fw-semibold mb-4">Integrated Environmental Monitoring System</p>
                <p class="text-muted fs-6 mx-auto" style="max-width: 42rem; line-height: 1.8;">
                    Memantau kondisi kualitas air (AQUAVISKA) dan iklim mikro (IoT Climate) secara real-time untuk pengambilan keputusan yang lebih cepat dan tepat.
                </p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            <span class="badge rounded-pill bg-success">&nbsp;</span>
                            <p class="mb-0 text-muted fw-semibold">Perangkat Normal</p>
                        </div>
                        <p class="display-6 fw-bold text-success">{{ $summary['normal'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-danger shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            <span class="badge rounded-pill bg-danger">&nbsp;</span>
                            <p class="mb-0 text-muted fw-semibold">Rusak / Offline</p>
                        </div>
                        <p class="display-6 fw-bold text-danger">{{ $summary['rusak_offline'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- SECTION 2: Penjelasan Singkat tentang Alat -->
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-cyan-500 hover:shadow-xl transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-cyan-100 p-3 rounded-full">
                            <i class="fas fa-tint text-cyan-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl">AQUAVISKA</h3>
                            <p class="text-gray-500 text-sm">Sensor Kualitas Air</p>
                        </div>
                    </div>
                    <p class="text-gray-600">Memantau parameter: Suhu (°C), pH (0-14), Kekeruhan (NTU), Dissolved Oxygen (mg/L), dan TDS (PPM).</p>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500 hover:shadow-xl transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-emerald-100 p-3 rounded-full">
                            <i class="fas fa-cloud-sun text-emerald-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl">IoT Climate</h3>
                            <p class="text-gray-500 text-sm">Sensor Iklim Mikro</p>
                        </div>
                    </div>
                    <p class="text-gray-600">Memantau parameter: Suhu (°C), Kelembapan (%), TVOC (mg/m³), CO₂ (ppm), UV Index, Kecepatan Angin (m/s), dan Curah Hujan (mm).</p>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Gambar Alat Teknologi -->
        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 py-12">
            <div class="max-w-7xl mx-auto px-6">
                <h3 class="font-bold text-2xl text-center mb-8 text-gray-800">Teknologi Kami</h3>
                <div class="flex justify-center items-center gap-12 flex-wrap">
                    <div class="text-center">
                        <img src="https://img.icons8.com/fluency/100/water-quality-monitor.png" alt="AQUAVISKA" class="w-24 h-24 mx-auto">
                        <p class="font-semibold mt-3">AQUAVISKA</p>
                        <p class="text-sm text-gray-500">Water Quality Sensor</p>
                    </div>
                    <div class="text-center">
                        <img src="https://img.icons8.com/fluency/100/weather-station.png" alt="IoT Climate" class="w-24 h-24 mx-auto">
                        <p class="font-semibold mt-3">IoT Climate</p>
                        <p class="text-sm text-gray-500">Climate Micro Sensor</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: Ringkasan per Lokasi -->
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-green-600"></i> Ringkasan per Lokasi
                </h2>
                <a href="{{ route('public.locations') }}" class="text-green-600 hover:underline">Lihat Semua →</a>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($locations as $loc)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                    <img src="{{ $loc->gambar }}" alt="{{ $loc->nama }}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-300">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-lg">{{ $loc->nama }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $loc->tipe }}</p>
                            </div>
                            <span class="status-badge 
                                @if($loc->status == 'Normal') status-normal 
                                @elseif($loc->status == 'Waspada') status-waspada 
                                @else status-rusak @endif">
                                {{ $loc->status }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 flex items-center gap-1">
                            <i class="fas fa-map-pin text-xs"></i> {{ Str::limit($loc->alamat, 45) }}
                        </p>
                        <a href="{{ route('public.location.detail', $loc->id) }}" class="inline-block mt-4 text-green-600 font-medium hover:underline">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- SECTION 5: Statistik Singkat & Widget Cuaca -->
        <div class="max-w-7xl mx-auto px-6 pb-12">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Statistik Singkat -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-green-600"></i> Statistik Sistem
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b pb-3">
                            <span class="text-gray-500">Total Perangkat Aktif</span>
                            <span class="text-2xl font-bold text-green-600">{{ $summary['total_aktif'] }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-3">
                            <span class="text-gray-500">Total Lokasi Terdaftar</span>
                            <span class="text-2xl font-bold text-blue-600">{{ $summary['total_lokasi'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Beroperasi Sejak</span>
                            <span class="font-semibold">23 Oktober 2025</span>
                        </div>
                    </div>
                </div>

                <!-- Widget Cuaca BMKG -->
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="font-semibold flex items-center gap-2 mb-4">
                        <i class="fas fa-cloud-sun text-yellow-200"></i> Cuaca & Prakiraan (BMKG)
                    </h3>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <div class="text-5xl font-bold">{{ $weather['suhu'] }}°C</div>
                            <div class="text-sky-100 mt-1">{{ $weather['kondisi'] }}</div>
                        </div>
                        <i class="fas fa-{{ $weather['icon'] ?? 'cloud-sun' }} text-6xl text-yellow-200"></i>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-white/20 rounded-lg p-2">
                            <span class="text-sky-100">Kelembaban</span>
                            <div class="font-semibold text-lg">{{ $weather['kelembaban'] }}%</div>
                        </div>
                        <div class="bg-white/20 rounded-lg p-2">
                            <span class="text-sky-100">Lokasi</span>
                            <div class="font-semibold text-lg">{{ $weather['kota'] }}</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-white/30">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-day"></i>
                            <span>Prakiraan: {{ $weather['prakiraan'] }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-sky-200 mt-2">*Terintegrasi dengan API BMKG</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Laporkan Masalah -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/6281234567890?text=Halo%20EQUITY%20UP%2C%20saya%20ingin%20melaporkan%20masalah%20pada%20sistem%20monitoring" 
           target="_blank" 
           class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-full shadow-lg transition transform hover:scale-105">
            <i class="fab fa-whatsapp text-xl"></i>
            <span class="font-semibold">Laporkan Masalah</span>
        </a>
    </div>
</div>

@endsection