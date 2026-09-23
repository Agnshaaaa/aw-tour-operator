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

            // ── Studi Tour ─────────────────────────────────────────────────
            [
                'category_id'       => $studiTour->id,
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
