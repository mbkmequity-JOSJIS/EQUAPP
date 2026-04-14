@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold">{{ $location->nama }}</h1>
            <p class="text-gray-500">{{ $location->alamat }} | {{ $location->pemilik }}</p>
            <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm 
                @if($location->status == 'Normal') bg-green-100 text-green-700
                @elseif($location->status == 'Waspada') bg-yellow-100 text-yellow-700
                @else bg-red-100 text-red-700 @endif">
                Status: {{ $location->status }}
            </span>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Skor Kondisi</p>
            <p class="text-3xl font-bold {{ $location->skor_kondisi >= 70 ? 'text-green-600' : 'text-orange-500' }}">{{ $location->skor_kondisi }}/100</p>
        </div>
    </div>

    <hr class="my-5">

    <!-- Kartu Sensor Lengkap -->
    <h2 class="text-xl font-semibold mb-3">📊 Data Sensor Real-time</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($location->sensors as $key => $sensor)
        <div class="border rounded-lg p-3">
            <div class="flex justify-between">
                <span class="font-medium capitalize">{{ str_replace('_', ' ', $key) }}</span>
                <span class="text-sm status-badge 
                    @if($sensor['status'] == 'Normal') status-normal 
                    @elseif($sensor['status'] == 'Waspada') status-waspada 
                    @else status-rusak @endif">
                    {{ $sensor['status'] }}
                </span>
            </div>
            <p class="text-2xl font-bold mt-1">{{ $sensor['value'] }} <span class="text-sm font-normal">{{ $sensor['unit'] }}</span></p>
            @if(isset($sensor['min']))
            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: {{ min(100, ($sensor['value'] - $sensor['min']) / ($sensor['max'] - $sensor['min']) * 100) }}%"></div>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Grafik Tren -->
    <div class="mt-8">
        <h3 class="font-semibold mb-2">📈 Grafik Tren (NTU / °C / %)</h3>
        <canvas id="sensorChart" height="100"></canvas>
        <div class="flex gap-3 mt-2 text-xs">
            <span>🟢 Kekeruhan (NTU)</span>
            <span>🔴 Suhu Air (°C)</span>
            <span>🔵 Kelembapan (%)</span>
        </div>
    </div>

    <!-- Rekomendasi Otomatis -->
    <div class="mt-8 bg-blue-50 p-4 rounded-lg">
        <h3 class="font-bold">🤖 Rekomendasi Tindakan</h3>
        @if($location->skor_kondisi >= 80)
            <p>✅ Kondisi Normal - Semua parameter dalam rentang aman.</p>
        @elseif($location->skor_kondisi >= 60)
            <p>⚠️ Perhatikan Pemantauan - Pantau kekeruhan dan suhu, lakukan pengecekan rutin.</p>
        @else
            <p>🔴 Peringatan - Beberapa sensor menunjukkan nilai kritis. Segera lakukan tindakan perbaikan.</p>
        @endif
        <p class="text-sm text-gray-600 mt-1">*Rekomendasi berubah otomatis berdasarkan data sensor terkini.</p>
    </div>

    <!-- Tombol Laporkan via WhatsApp -->
    <div class="mt-6">
        <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20melaporkan%20masalah%20pada%20lokasi%3A%20{{ urlencode($location->nama) }}%0AID%20Perangkat%3A%20{{ $location->tipe }}-{{ $location->id }}%0AKondisi%20Saat%20Ini%3A%20{{ $location->status }}%20(Skor%20{{ $location->skor_kondisi }})%0AMohon%20bantuan%20pengecekan.%20Terima%20kasih." target="_blank" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
            <i class="fab fa-whatsapp"></i> Laporkan Masalah via WhatsApp
        </a>
    </div>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('sensorChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['00:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'],
            datasets: [
                { label: 'Kekeruhan (NTU)', data: {{ json_encode($location->grafikData ?? [85,84,83,86,87,85,84,82,83,85,86,84]) }}, borderColor: '#10b981', tension: 0.3 },
                { label: 'Suhu Air (°C)', data: [28,28,27.5,27.8,28.2,28.5,28.7,29,28.9,28.6,28.4,28.3], borderColor: '#ef4444', tension: 0.3 },
                { label: 'Kelembapan (%)', data: [78,77,79,80,78,76,75,74,73,74,75,76], borderColor: '#3b82f6', tension: 0.3 }
            ]
        },
        options: { responsive: true, maintainAspectRatio: true }
    });
</script>
@endpush
@endsection