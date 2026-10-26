<?php

namespace Database\Seeders;

use App\Models\TransportOffering;
use Illuminate\Database\Seeder;

class TransportOfferingSeeder extends Seeder
{
    public function run(): void
    {
        $offerings = [
            [
                'name' => 'Hiace', 'slug' => 'hiace',
                'capacity' => '14–19 seat', 'price_label' => 'Mulai dari Rp1.000.000/hari',
                'description' => 'Cocok untuk perjalanan rombongan kecil dan perjalanan yang lebih fleksibel.',
                'features' => ['Rombongan kecil', 'Fleksibel & nyaman', 'Full AC'], 'sort_order' => 1,
            ],
            [
                'name' => 'Medium Bus', 'slug' => 'medium-bus',
                'capacity' => '30–35 seat', 'price_label' => 'Rp2.500.000–Rp3.000.000/hari',
                'description' => 'Pilihan armada untuk rombongan dengan jumlah peserta menengah.',
                'features' => ['Kapasitas menengah', 'Full AC & bagasi', 'Reclining seat'], 'sort_order' => 2,
            ],
            [
                'name' => 'Big Bus', 'slug' => 'big-bus',
                'capacity' => '45–59 seat', 'price_label' => 'Rp3.500.000–Rp4.000.000/hari',
                'description' => 'Armada berkapasitas besar untuk perjalanan rombongan.',
                'features' => ['Kapasitas besar', 'Full AC & multimedia', 'Bagasi luas'], 'sort_order' => 3,
            ],
        ];

        foreach ($offerings as $offering) {
            TransportOffering::firstOrCreate(['slug' => $offering['slug']], $offering);
        }
    }
}
