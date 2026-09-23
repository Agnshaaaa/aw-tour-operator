<?php

namespace Database\Seeders;

use App\Models\UmkmProduct;
use Illuminate\Database\Seeder;

/**
 * Seeder: UmkmProductSeeder
 *
 * Membuat data awal produk UMKM lokal untuk katalog etalase.
 * Produk-produk ini dapat dipilih klien sebagai add-on
 * saat mengisi form quotation rombongan.
 *
 * Cara jalankan:
 * php artisan db:seed --class=UmkmProductSeeder
 */
class UmkmProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'         => 'Batik Tulis Surabaya',
                'slug'         => 'batik-tulis-surabaya',
                'producer'     => 'UMKM Batik Pesisir Surabaya',
                'description'  => 'Batik tulis khas Surabaya dengan motif mega mendung dan '
                                . 'flora laut. Dibuat secara tradisional oleh pengrajin lokal.',
                'price'        => 185000,
                'unit'         => 'lembar',
                'is_available' => true,
            ],
            [
                'name'         => 'Keripik Tempe Malang',
                'slug'         => 'keripik-tempe-malang',
                'producer'     => 'UD Tempe Sari Malang',
                'description'  => 'Keripik tempe renyah khas Malang. Tersedia rasa original, '
                                . 'balado, dan keju. Cocok sebagai oleh-oleh.',
                'price'        => 35000,
                'unit'         => 'pcs',
                'is_available' => true,
            ],
            [
                'name'         => 'Kopi Ijen Banyuwangi',
                'slug'         => 'kopi-ijen-banyuwangi',
                'producer'     => 'Kelompok Tani Kopi Ijen',
                'description'  => 'Kopi arabika single origin dari lereng Gunung Ijen. '
                                . 'Profil rasa: fruity, floral, dengan aftertaste cokelat.',
                'price'        => 120000,
                'unit'         => '250g',
                'is_available' => true,
            ],
            [
                'name'         => 'Sambal Bawang Bu Rudy',
                'slug'         => 'sambal-bawang-bu-rudy',
                'producer'     => 'UMKM Bu Rudy Surabaya',
                'description'  => 'Sambal bawang legendaris khas Surabaya. '
                                . 'Level pedas: sedang. Tanpa pengawet, tahan 2 minggu.',
                'price'        => 45000,
                'unit'         => 'botol',
                'is_available' => true,
            ],
            [
                'name'         => 'Jenang Kudus',
                'slug'         => 'jenang-kudus',
                'producer'     => 'UMKM Jenang Mubarok',
                'description'  => 'Jenang tradisional Kudus dengan rasa manis legit. '
                                . 'Tersedia rasa original, wijen, dan durian.',
                'price'        => 55000,
                'unit'         => 'box',
                'is_available' => true,
            ],
            [
                'name'         => 'Tas Anyaman Bambu',
                'slug'         => 'tas-anyaman-bambu',
                'producer'     => 'Pengrajin Bambu Batu Malang',
                'description'  => 'Tas ramah lingkungan dari anyaman bambu pilihan. '
                                . 'Unik, kuat, dan cocok sebagai souvenir eksklusif.',
                'price'        => 95000,
                'unit'         => 'pcs',
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            UmkmProduct::create($product);
        }

        $this->command->info('✅ UmkmProductSeeder: ' . count($products) . ' produk UMKM berhasil dibuat.');
    }
}
