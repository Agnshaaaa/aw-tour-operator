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

        $albumMedia = [
            'Corporate Gathering PT Semen Indonesia — Sunrise Bromo Expedition' => [
                ['type' => 'image', 'file_path' => 'images/Bromo.jpg', 'caption' => 'Foto Bersama Rombongan 120 Karyawan di Penanjakan 1 Bromo'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Konvoi 20 Unit Jeep Hardtop 4x4 Menyusuri Lautan Pasir'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Puncak Kawah Bromo & Keindahan Kaldera Tengger'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1605649487212-47bdab064df7?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Sesi Fun Games & Ice Breaking di Bukit Teletubbies'],
                ['type' => 'video', 'file_path' => 'https://www.youtube.com/watch?v=1F3X1N_wTio', 'caption' => 'Aftermovie Sinematik: Sunrise Bromo Gathering PT Semen Indonesia'],
            ],
            'Studi Ekskursi BEM FT Universitas Negeri Surabaya — Yogyakarta Smart City' => [
                ['type' => 'image', 'file_path' => 'images/Bromo.jpg', 'caption' => 'Rombongan Mahasiswa UNESA di Depan Candi Prambanan'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Eksplorasi Budaya & Kerajinan Khas Malioboro Yogyakarta'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=1200&q=80', 'caption' => '2 Armada Big Bus Executive Pariwisata AW Tour Standby'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Sunset Gathering & Gala Dinner di Pantai Indrayanti'],
                ['type' => 'video', 'file_path' => 'https://www.youtube.com/watch?v=1F3X1N_wTio', 'caption' => 'Vlog Keseruan Studi Ekskursi Yogyakarta — BEM FT UNESA'],
            ],
            'Capacity Building & Team Bonding Bank Jatim — Coban Rondo Batu Malang' => [
                ['type' => 'image', 'file_path' => 'images/Bromo.jpg', 'caption' => 'Foto Pelepasan Armada Bus Bank Jatim dari Kantor Pusat Surabaya'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Outbound Training & Rafting di Coban Rondo Batu Malang'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Malam Keakraban & Barbeque Dinner di Resort Batu'],
                ['type' => 'video', 'file_path' => 'https://www.youtube.com/watch?v=1F3X1N_wTio', 'caption' => 'Highlight Video Capacity Building Bank Jatim 2026'],
            ],
            'Family Gathering Ikatan Alumni SMA Negeri 5 Surabaya — Bali Island Heritage' => [
                ['type' => 'image', 'file_path' => 'images/Bromo.jpg', 'caption' => 'Foto Keluarga Besar Alumni di Garuda Wisnu Kencana (GWK) Bali'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Pemandangan Tebing dan Sunset di Pura Uluwatu'],
                ['type' => 'image', 'file_path' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80', 'caption' => 'Romantic Seafood Dinner Bersama Rombongan di Pantai Jimbaran'],
                ['type' => 'video', 'file_path' => 'https://www.youtube.com/watch?v=1F3X1N_wTio', 'caption' => 'Dokumentasi Video Kenangan Liburan Keluarga Alumni di Bali'],
            ],
        ];

        foreach ($samples as $sample) {
            $doc = Documentation::updateOrCreate(
                ['title' => $sample['title']],
                $sample
            );

            // Re-seed media items jika belum ada
            if ($doc->media()->count() === 0 && isset($albumMedia[$doc->title])) {
                $sort = 1;
                foreach ($albumMedia[$doc->title] as $item) {
                    $doc->media()->create([
                        'type'       => $item['type'],
                        'file_path'  => $item['file_path'],
                        'caption'    => $item['caption'],
                        'sort_order' => $sort++,
                    ]);
                }
            }
        }
    }
}
