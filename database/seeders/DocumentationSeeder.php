<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Documentation;
use Illuminate\Database\Seeder;

class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bromo = Destination::where('slug', 'like', '%bromo%')->first() ?? Destination::first();
        $jogja = Destination::where('slug', 'like', '%yogyakarta%')->orWhere('slug', 'like', '%jogja%')->first();
        $batu  = Destination::where('slug', 'like', '%batu%')->orWhere('slug', 'like', '%malang%')->first();
        $bali  = Destination::where('slug', 'like', '%bali%')->first();

        $samples = [
            [
                'title'             => 'Corporate Gathering PT Semen Indonesia — Sunrise Bromo Expedition',
                'destination_id'    => $bromo ? $bromo->id : null,
                'description'       => 'Dokumentasi kegiatan gathering tahunan 120 karyawan PT Semen Indonesia mengeksplorasi Kawah Bromo, Pasir Berbisik, dan Bukit Teletubbies dengan 20 unit Jeep Hardtop 4x4.',
                'image_path'        => 'images/Bromo.jpg',
                'trip_date'         => '2026-08-15',
                'participant_count' => 120,
                'badge_text'        => 'Rombongan Tour Terbanyak - 50+ Trip',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 1,
            ],
            [
                'title'             => 'Studi Ekskursi BEM FT Universitas Negeri Surabaya — Yogyakarta Smart City',
                'destination_id'    => $jogja ? $jogja->id : null,
                'description'       => 'Perjalanan studi tour 90 mahasiswa teknik UNESA mengunjungi pusat industri kreatif dan budaya Malioboro, Candi Prambanan, dan Pantai Indrayanti menggunakan 2 armada Big Bus Executive.',
                'image_path'        => 'images/Bromo.jpg',
                'trip_date'         => '2026-07-20',
                'participant_count' => 90,
                'badge_text'        => 'Studi Tour Kampus Favorit',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 2,
            ],
            [
                'title'             => 'Capacity Building & Team Bonding Bank Jatim — Coban Rondo Batu Malang',
                'destination_id'    => $batu ? $batu->id : null,
                'description'       => 'Sesi outbound motivasi dan rafting seru tim operasional Bank Jatim di kawasan sejuk Batu Malang dengan akomodasi hotel bintang 4 dan armada bus pariwisata premium.',
                'image_path'        => 'images/Bromo.jpg',
                'trip_date'         => '2026-09-05',
                'participant_count' => 65,
                'badge_text'        => 'Corporate Team Building',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 3,
            ],
            [
                'title'             => 'Family Gathering Ikatan Alumni SMA Negeri 5 Surabaya — Bali Island Heritage',
                'destination_id'    => $bali ? $bali->id : null,
                'description'       => 'Perjalanan wisata keluarga besar alumni menyusuri keindahan Garuda Wisnu Kencana, Pantai Pandawa, dan gala dinner di Jimbaran.',
                'image_path'        => 'images/Bromo.jpg',
                'trip_date'         => '2026-06-10',
                'participant_count' => 80,
                'badge_text'        => 'Family Gathering Spektakuler',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 4,
            ],
        ];

        foreach ($samples as $sample) {
            Documentation::updateOrCreate(
                ['title' => $sample['title']],
                $sample
            );
        }
    }
}
