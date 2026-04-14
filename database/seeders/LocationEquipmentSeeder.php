<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Equipment;
use Illuminate\Database\Seeder;

class LocationEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample locations
        $locations = [
            [
                'name' => 'Lokasi Utama',
                'description' => 'Pusat Operasional Sistem EQUITY UP',
                'address' => 'Jalan Merdeka No. 1, Jakarta',
            ],
            [
                'name' => 'Lokasi Cabang A',
                'description' => 'Fasilitas Monitoring Zona A',
                'address' => 'Jalan Sudirman No. 10, Bandung',
            ],
            [
                'name' => 'Lokasi Cabang B',
                'description' => 'Fasilitas Monitoring Zona B',
                'address' => 'Jalan Ahmad Yani No. 5, Surabaya',
            ],
        ];

        foreach ($locations as $locationData) {
            $location = Location::create($locationData);

            // Create equipment for each location
            Equipment::create([
                'location_id' => $location->id,
                'name' => 'AQUAVISKA Unit 1',
                'type' => 'AQUAVISKA',
                'status' => 'normal',
                'description' => 'Sensor Monitoring Kualitas Air',
            ]);

            Equipment::create([
                'location_id' => $location->id,
                'name' => 'IOT Climate Sensor 1',
                'type' => 'IOT_CLIMATE',
                'status' => 'normal',
                'description' => 'Sensor Monitoring Iklim dan Lingkungan',
            ]);

            Equipment::create([
                'location_id' => $location->id,
                'name' => 'AQUAVISKA Unit 2',
                'type' => 'AQUAVISKA',
                'status' => 'warning',
                'description' => 'Sensor Backup Kualitas Air',
            ]);

            if ($location->id === 2) {
                Equipment::create([
                    'location_id' => $location->id,
                    'name' => 'IOT Climate Sensor 2',
                    'type' => 'IOT_CLIMATE',
                    'status' => 'broken',
                    'description' => 'Sensor Monitoring Sekunder (Offline)',
                ]);
            }
        }
    }
}
