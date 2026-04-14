<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Data statis lokasi & perangkat
    private function getLocations()
    {
        return [
            (object) [
                'id' => 1,
                'nama' => 'Rowo Jombor',
                'alamat' => 'Klaten, Jombor Rt 02/01',
                'pemilik' => 'Bapak Samilan',
                'tipe' => 'AQUAVISKA',
                'status' => 'Normal',
                'isResponsive' => true,
                'gambar' => 'https://picsum.photos/id/104/400/250', // gambar danau/air
                'sensors' => [
                    'suhu' => ['value' => 28.5, 'unit' => '°C', 'status' => 'Normal', 'min' => 20, 'max' => 32],
                    'ph' => ['value' => 7.2, 'unit' => '', 'status' => 'Normal', 'min' => 6.5, 'max' => 8.5],
                    'kekeruhan' => ['value' => 85.7, 'unit' => 'NTU', 'status' => 'Waspada', 'min' => 0, 'max' => 100],
                    'do' => ['value' => 6.2, 'unit' => 'mg/L', 'status' => 'Normal', 'min' => 4, 'max' => 9],
                    'tds' => ['value' => 210, 'unit' => 'PPM', 'status' => 'Normal', 'min' => 0, 'max' => 500],
                ],
                'skor_kondisi' => 78,
                'grafikData' => [85, 84, 83, 86, 87, 85, 84, 82, 83, 85, 86, 84],
            ],
            (object) [
                'id' => 2,
                'nama' => 'Sungai Cikapundung',
                'alamat' => 'Bandung, Jawa Barat',
                'pemilik' => 'Dinas Lingkungan',
                'tipe' => 'AQUAVISKA',
                'status' => 'Waspada',
                'isResponsive' => true,
                'gambar' => 'https://picsum.photos/id/143/400/250', // gambar sungai
                'sensors' => [
                    'suhu' => ['value' => 29.0, 'unit' => '°C', 'status' => 'Normal'],
                    'ph' => ['value' => 6.8, 'unit' => '', 'status' => 'Normal'],
                    'kekeruhan' => ['value' => 120.3, 'unit' => 'NTU', 'status' => 'Waspada'],
                    'do' => ['value' => 4.5, 'unit' => 'mg/L', 'status' => 'Waspada'],
                    'tds' => ['value' => 320, 'unit' => 'PPM', 'status' => 'Normal'],
                ],
                'skor_kondisi' => 62,
                'grafikData' => [120, 118, 122, 125, 119, 121, 123, 120, 118, 124, 126, 121],
            ],
            (object) [
                'id' => 3,
                'nama' => 'Kebun Raya Bogor',
                'alamat' => 'Bogor, Jawa Barat',
                'pemilik' => 'Pusat Konservasi',
                'tipe' => 'IOT Climate',
                'status' => 'Rusak',
                'isResponsive' => false,
                'gambar' => 'https://picsum.photos/id/96/400/250', // gambar kebun
                'sensors' => [
                    'suhu' => ['value' => 27.0, 'unit' => '°C', 'status' => 'Normal'],
                    'kelembapan' => ['value' => 82, 'unit' => '%', 'status' => 'Normal'],
                    'kualitas_udara_tvoc' => ['value' => 0.3, 'unit' => 'mg/m³', 'status' => 'Normal'],
                    'co2' => ['value' => 410, 'unit' => 'ppm', 'status' => 'Normal'],
                    'uv_index' => ['value' => 4, 'unit' => '', 'status' => 'Normal'],
                    'kecepatan_angin' => ['value' => 3.2, 'unit' => 'm/s', 'status' => 'Normal'],
                    'curah_hujan' => ['value' => 0, 'unit' => 'mm', 'status' => 'Normal'],
                ],
                'skor_kondisi' => 0,
                'grafikData' => [null],
            ],
            (object) [
                'id' => 4,
                'nama' => 'Pantai Selatan',
                'alamat' => 'Gunungkidul, Yogyakarta',
                'pemilik' => 'Kelompok Nelayan',
                'tipe' => 'IOT Climate',
                'status' => 'Normal',
                'isResponsive' => true,
                'gambar' => 'https://picsum.photos/id/15/400/250', // gambar pantai
                'sensors' => [
                    'suhu' => ['value' => 30.5, 'unit' => '°C', 'status' => 'Normal'],
                    'kelembapan' => ['value' => 75, 'unit' => '%', 'status' => 'Normal'],
                    'kualitas_udara_tvoc' => ['value' => 0.2, 'unit' => 'mg/m³', 'status' => 'Normal'],
                    'co2' => ['value' => 400, 'unit' => 'ppm', 'status' => 'Normal'],
                    'uv_index' => ['value' => 8, 'unit' => '', 'status' => 'Waspada'],
                    'kecepatan_angin' => ['value' => 5.5, 'unit' => 'm/s', 'status' => 'Normal'],
                    'curah_hujan' => ['value' => 0, 'unit' => 'mm', 'status' => 'Normal'],
                ],
                'skor_kondisi' => 88,
                'grafikData' => [75, 74, 76, 77, 75, 74, 73, 75, 76, 77, 78, 76],
            ],
        ];
    }

    private function getDeviceSummary()
    {
        $locations = $this->getLocations();
        $normal = 0;
        $rusakOffline = 0;
        foreach ($locations as $loc) {
            if ($loc->status == 'Normal') {
                $normal++;
            } else {
                $rusakOffline++;
            }
        }
        return [
            'normal' => $normal,
            'rusak_offline' => $rusakOffline,
            'total_aktif' => count(array_filter($locations, fn($l) => $l->isResponsive)),
            'total_lokasi' => count($locations),
        ];
    }

    public function dashboard()
    {
        $summary = $this->getDeviceSummary();
        $locations = $this->getLocations();
        
        // Widget Cuaca BMKG (simulasi - nanti integrasi API real)
        $weather = [
            'suhu' => 28,
            'kondisi' => 'Berawan',
            'kelembaban' => 78,
            'kota' => 'Klaten, Jawa Tengah',
            'prakiraan' => 'Hujan ringan pada sore hari',
            'icon' => 'cloud-sun', // cloud, sun, cloud-rain, dll
        ];
        
        return view('public.dashboard', compact('summary', 'locations', 'weather'));
    }

    public function locations(Request $request)
    {
        $filter = $request->get('filter', 'semua');
        $locations = $this->getLocations();
        if ($filter !== 'semua') {
            $locations = array_filter($locations, fn($l) => strtolower($l->tipe) === strtolower($filter));
        }
        return view('public.locations', compact('locations', 'filter'));
    }

    public function locationDetail($id)
    {
        $locations = $this->getLocations();
        $location = collect($locations)->firstWhere('id', $id);
        if (!$location) {
            abort(404);
        }
        return view('public.location-detail', compact('location'));
    }

    public function developer()
    {
        $team = [
            ['nama' => 'Andi Pratama', 'role' => 'Project Lead & Backend', 'foto' => 'https://ui-avatars.com/api/?background=0D8F81&color=fff&name=Andi'],
            ['nama' => 'Budi Santoso', 'role' => 'IoT Engineer', 'foto' => 'https://ui-avatars.com/api/?background=0D8F81&color=fff&name=Budi'],
            ['nama' => 'Citra Dewi', 'role' => 'Frontend & UI/UX', 'foto' => 'https://ui-avatars.com/api/?background=0D8F81&color=fff&name=Citra'],
            ['nama' => 'Dian Nuraeni', 'role' => 'Data Analyst', 'foto' => 'https://ui-avatars.com/api/?background=0D8F81&color=fff&name=Dian'],
        ];
        return view('public.developer', compact('team'));
    }
}