<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Destination;
use App\Models\DestinationDetail;
use Illuminate\Database\Seeder;

/**
 * Seeder: DestinationSeeder
 *
 * Membuat data awal destinasi wisata untuk katalog AW Tour Operator.
 * Setiap destinasi juga memiliki data detail (itinerary, inclusions, dll).
 *
 * Cara jalankan:
 * php artisan db:seed --class=DestinationSeeder
 *
 * CATATAN: CategorySeeder harus dijalankan terlebih dahulu
 * karena tabel destinations memiliki FK ke tabel categories.
 */
class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID kategori dari database
        $studiTour       = Category::where('slug', 'studi-tour')->first();
        $capacityBuild   = Category::where('slug', 'capacity-building')->first();
        $familyGathering = Category::where('slug', 'family-gathering')->first();

        // ── Daftar Destinasi ───────────────────────────────────────────────
        $destinations = [

            // ── Destinasi Luar Negeri (Internasional) ───────────────────────
            [
                'category_id'       => $studiTour->id,
                'location_type'     => 'luar_negeri',
                'name'              => 'Singapore City Tour & Universal Studios',
                'slug'              => 'singapore-city-tour-universal-studios',
                'location'          => 'Singapore',
                'short_description' => 'Paket eksplorasi keindahan Marina Bay Sands, Jewel Changi, Merlion Park, hingga keseruan di Universal Studios Singapore untuk rombongan B2B & sekolah.',
                'min_price'         => 4500000,
                'max_price'         => 7500000,
                'min_pax'           => 15,
                'is_featured'       => true,
                'is_active'         => true,
                'cover_image'       => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=1000&q=80',
                'inclusions'        => ['Tiket Pesawat PP', 'Hotel Bintang 3 (2 Malam)', 'Tiket Universal Studios Singapore', 'Makan 3x Sehari', 'Tour Guide Berpengalaman', 'Transportasi Bus AC Eksklusif'],
                'exclusions'        => ['Paspor & Pengeluaran Pribadi', 'Tip Guide & Driver Sukarela'],
                'itinerary'         => [
                    ['hari' => 1, 'judul' => 'Surabaya → Changi Airport → Marina Bay', 'kegiatan' => 'Terbang ke Singapura, kunjungan Jewel Changi, foto di Marina Bay Sands & Merlion Park'],
                    ['hari' => 2, 'judul' => 'Universal Studios Singapore (USS) & Sentosa', 'kegiatan' => 'Full day seharian seru di Universal Studios Singapore dan Sentosa Island'],
                    ['hari' => 3, 'judul' => 'Bugis Street → Surabaya', 'kegiatan' => 'Belanja oleh-oleh di Bugis Street & Orchard Road, transfer ke Changi Airport, kembali ke Surabaya'],
                ],
                'notes' => 'Peserta wajib memiliki paspor yang masih berlaku minimal 6 bulan sebelum keberangkatan.',
            ],

            [
                'category_id'       => $studiTour->id,
                'location_type'     => 'luar_negeri',
                'name'              => 'Kuala Lumpur & Genting Highlands',
                'slug'              => 'kuala-lumpur-genting-highlands',
                'location'          => 'Kuala Lumpur, Malaysia',
                'short_description' => 'Jelajahi ikon Menara Kembar Petronas, Batu Caves, hingga menikmati kereta gantung dan hiburan puncak Genting Highlands.',
                'min_price'         => 3800000,
                'max_price'         => 6200000,
                'min_pax'           => 15,
                'is_featured'       => true,
                'is_active'         => true,
                'cover_image'       => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?auto=format&fit=crop&w=1000&q=80',
                'inclusions'        => ['Tiket Pesawat PP', 'Hotel Bintang 3 (2 Malam)', 'Tiket Awana SkyWay Genting', 'Makan 3x Sehari', 'Tour Guide Profesional', 'Transportasi Bus Pariwisata AC'],
                'exclusions'        => ['Paspor & Pengeluaran Pribadi', 'Tip Guide & Driver'],
                'itinerary'         => [
                    ['hari' => 1, 'judul' => 'Surabaya → Kuala Lumpur', 'kegiatan' => 'Penerbangan ke KLIA, city tour singkat Dataran Merdeka & Petronas Twin Towers'],
                    ['hari' => 2, 'judul' => 'Genting Highlands & Batu Caves', 'kegiatan' => 'Kunjungan ke kuil suci Batu Caves, naik kereta gantung Awana SkyWay ke puncak Genting Highlands'],
                    ['hari' => 3, 'judul' => 'Bukit Bintang → Surabaya', 'kegiatan' => 'Belanja di Bukit Bintang / Petaling Street, transfer ke bandara untuk penerbangan pulang ke Surabaya'],
                ],
                'notes' => 'Pastikan paspor valid dan membawa mata uang Ringgit Malaysia (MYR) secukupnya.',
            ],

            // ── Studi Tour ─────────────────────────────────────────────────
            [
                'category_id'       => $studiTour->id,
                'location_type'     => 'lokal',
                'name'              => 'Bromo Tengger Semeru',
                'slug'              => 'bromo-tengger-semeru',
                'location'          => 'Malang, Jawa Timur',
                'short_description' => 'Saksikan keajaiban matahari terbit di atas lautan awan '
                                     . 'Bromo yang ikonik. Destinasi wajib untuk studi tour alam.',
                'min_price'         => 850000,
                'max_price'         => 1500000,
                'min_pax'           => 20,
                'is_featured'       => true,
                'is_active'         => true,
                // Detail destinasi
                'inclusions' => ['Transportasi bus AC', 'Hotel 2 malam', 'Makan 3x sehari', 'Guide lokal', 'Tiket masuk TNBTS'],
                'exclusions' => ['Sewa kuda', 'Pengeluaran pribadi', 'Tip guide'],
                'itinerary'  => [
                    ['hari' => 1, 'judul' => 'Surabaya → Malang', 'kegiatan' => 'Berangkat sore, check-in hotel Cemoro Lawang'],
                    ['hari' => 2, 'judul' => 'Sunrise Bromo', 'kegiatan' => 'Subuh ke penanjakan, turun ke lautan pasir, kawah Bromo'],
                    ['hari' => 3, 'judul' => 'Malang City Tour → Surabaya', 'kegiatan' => 'Kunjungan Jatim Park, makan siang, balik Surabaya'],
                ],
                'notes' => 'Disarankan membawa jaket tebal karena suhu bisa mencapai 5°C di malam hari.',
            ],

            [
                'category_id'       => $studiTour->id,
                'location_type'     => 'lokal',
                'name'              => 'Kawah Ijen & Banyuwangi',
                'slug'              => 'kawah-ijen-banyuwangi',
                'location'          => 'Banyuwangi, Jawa Timur',
                'short_description' => 'Fenomena blue fire langka yang hanya ada 2 di dunia. '
                                     . 'Cocok untuk studi tour geologi dan lingkungan hidup.',
                'min_price'         => 750000,
                'max_price'         => 1200000,
                'min_pax'           => 15,
                'is_featured'       => true,
                'is_active'         => true,
                'inclusions' => ['Transportasi bus AC', 'Hotel 1 malam', 'Makan 2x', 'Masker gas gratis', 'Guide lokal'],
                'exclusions' => ['Pengeluaran pribadi', 'Sertifikat blue fire (opsional)'],
                'itinerary'  => [
                    ['hari' => 1, 'judul' => 'Surabaya → Banyuwangi', 'kegiatan' => 'Perjalanan siang, check-in, briefing'],
                    ['hari' => 2, 'judul' => 'Blue Fire Ijen', 'kegiatan' => 'Dini hari naik ke kawah, saksikan blue fire, turun & balik Surabaya'],
                ],
                'notes' => 'Peserta disarankan dalam kondisi fisik yang baik. Trek menanjak ±3 km.',
            ],

            // ── Capacity Building ──────────────────────────────────────────
            [
                'category_id'       => $capacityBuild->id,
                'location_type'     => 'lokal',
                'name'              => 'Outbound Batu Malang',
                'slug'              => 'outbound-batu-malang',
                'location'          => 'Batu, Malang, Jawa Timur',
                'short_description' => 'Program outbound dan team building di udara sejuk Kota Batu. '
                                     . 'Kombinasi permainan kreatif dan sesi motivasi.',
                'min_price'         => 600000,
                'max_price'         => 1100000,
                'min_pax'           => 30,
                'is_featured'       => true,
                'is_active'         => true,
                'inclusions' => ['Transportasi bus AC', 'Makan siang & snack', 'Fasilitator outbound', 'Alat permainan', 'Sertifikat'],
                'exclusions' => ['Hotel (day trip)', 'Pengeluaran pribadi'],
                'itinerary'  => [
                    ['hari' => 1, 'judul' => 'Day Trip Outbound', 'kegiatan' => 'Berangkat pagi, games pembukaan, outbound sesi 1 & 2, makan siang, games penutup, evaluasi, pulang'],
                ],
                'notes' => 'Bisa dikombinasikan dengan kunjungan wisata Jatim Park atau Museum Angkut.',
            ],

            // ── Family Gathering ───────────────────────────────────────────
            [
                'category_id'       => $familyGathering->id,
                'location_type'     => 'lokal',
                'name'              => 'Lombok & Gili Islands',
                'slug'              => 'lombok-gili-islands',
                'location'          => 'Lombok, Nusa Tenggara Barat',
                'short_description' => 'Pantai pasir putih, snorkeling di Gili Trawangan, '
                                     . 'dan keindahan alam Lombok untuk family gathering tak terlupakan.',
                'min_price'         => 2500000,
                'max_price'         => 4500000,
                'min_pax'           => 25,
                'is_featured'       => false,
                'is_active'         => true,
                'inclusions' => ['Tiket pesawat PP', 'Hotel bintang 3 (3 malam)', 'Makan 3x sehari', 'Snorkeling equipment', 'Fast boat Gili', 'Guide'],
                'exclusions' => ['Pengeluaran pribadi', 'Oleh-oleh', 'Tip guide & driver'],
                'itinerary'  => [
                    ['hari' => 1, 'judul' => 'Surabaya → Lombok', 'kegiatan' => 'Terbang ke Lombok, check-in, dinner bersama'],
                    ['hari' => 2, 'judul' => 'Gili Trawangan', 'kegiatan' => 'Fast boat ke Gili T, snorkeling, beach party'],
                    ['hari' => 3, 'judul' => 'Senggigi & Sasak Village', 'kegiatan' => 'Tour Pantai Senggigi, kunjungan desa tradisional Sasak'],
                    ['hari' => 4, 'judul' => 'Lombok → Surabaya', 'kegiatan' => 'Free morning, check-out, terbang balik Surabaya'],
                ],
                'notes' => 'Harga dapat berubah sesuai musim. Booking minimal H-30.',
            ],
        ];

        // ── Simpan ke Database ─────────────────────────────────────────────
        foreach ($destinations as $data) {
            // Pisahkan data detail dari data utama destinasi
            $detailData = [
                'inclusions' => $data['inclusions'],
                'exclusions' => $data['exclusions'],
                'itinerary'  => $data['itinerary'],
                'notes'      => $data['notes'],
            ];

            // Hapus key detail dari array utama
            unset($data['inclusions'], $data['exclusions'], $data['itinerary'], $data['notes']);

            // Simpan destinasi utama
            $destination = Destination::create($data);

            // Simpan detail destinasi (relasi hasOne)
            $destination->detail()->create($detailData);
        }

        $this->command->info('✅ DestinationSeeder: ' . count($destinations) . ' destinasi berhasil dibuat.');
    }
}
