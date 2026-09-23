<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\OpenTrip;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Seeder: OpenTripSeeder
 *
 * Menambahkan data awal Open Trip publik untuk AW Tour Operator.
 */
class OpenTripSeeder extends Seeder
{
    public function run(): void
    {
        $bromo = Destination::where('slug', 'bromo-sunrise-tour')->first();
        $batu  = Destination::where('slug', 'batu-malang-family-gathering')->first();
        $kawah = Destination::where('slug', 'kawah-ijen-blue-fire')->first();
        $jogja = Destination::where('slug', 'jogja-heritage-tour')->first();

        $trips = [
            [
                'destination_id'   => $bromo ? $bromo->id : 1,
                'title'            => 'Open Trip Bromo Sunrise & Savana Tegal Pasir',
                'departure_date'   => Carbon::now()->addDays(15)->format('Y-m-d'),
                'return_date'      => Carbon::now()->addDays(17)->format('Y-m-d'),
                'quota'            => 20,
                'registered'       => 14,
                'price_per_person' => 850000,
                'highlight'        => 'Nikmati keindahan Golden Sunrise Penanjakan 1, Jeep 4x4 Kawah Bromo, Pasir Berbisik, dan Savana Bukit Teletubbies.',
                'status'           => 'open',
            ],
            [
                'destination_id'   => $kawah ? $kawah->id : 3,
                'title'            => 'Open Trip Kawah Ijen Blue Fire & Baluran Exotic East Java',
                'departure_date'   => Carbon::now()->addDays(22)->format('Y-m-d'),
                'return_date'      => Carbon::now()->addDays(25)->format('Y-m-d'),
                'quota'            => 15,
                'registered'       => 9,
                'price_per_person' => 1250000,
                'highlight'        => 'Trekking nocturnal menyaksikan fenomena langka Blue Fire Kawah Ijen, Danau Asam, dan Afrika van Java Taman Nasional Baluran.',
                'status'           => 'open',
            ],
            [
                'destination_id'   => $batu ? $batu->id : 2,
                'title'            => 'Open Trip Batu Floral & Agro Wisata Petik Apel',
                'departure_date'   => Carbon::now()->addDays(30)->format('Y-m-d'),
                'return_date'      => Carbon::now()->addDays(32)->format('Y-m-d'),
                'quota'            => 25,
                'registered'       => 18,
                'price_per_person' => 650000,
                'highlight'        => 'Wisata edukasi petik apel segar langsung dari kebun Batu, Flora Wisata San Terra, dan Museum Angkut Kota Batu.',
                'status'           => 'open',
            ],
            [
                'destination_id'   => $jogja ? $jogja->id : 4,
                'title'            => 'Open Trip Excursion Jogja Culture & Lava Tour Merapi',
                'departure_date'   => Carbon::now()->addDays(45)->format('Y-m-d'),
                'return_date'      => Carbon::now()->addDays(48)->format('Y-m-d'),
                'quota'            => 30,
                'registered'       => 22,
                'price_per_person' => 1450000,
                'highlight'        => 'Sensasi Offroad Jeep Lava Tour Merapi, Sunset Candi Prambanan, Malioboro Night Walk, dan Sentra Gudeg Wijilan.',
                'status'           => 'open',
            ],
        ];

        foreach ($trips as $trip) {
            OpenTrip::create($trip);
        }
    }
}
