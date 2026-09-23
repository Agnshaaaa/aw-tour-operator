<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder: DatabaseSeeder
 *
 * Seeder utama yang memanggil semua seeder aplikasi AW Tour Operator
 * secara berurutan sesuai relasi/dependencies.
 *
 * Urutan pemanggilan:
 * 1. UserSeeder        → Buat akun admin (tidak ada dependency)
 * 2. CategorySeeder    → Buat kategori layanan (tidak ada dependency)
 * 3. DestinationSeeder → Buat destinasi & detailnya (butuh Category)
 * 4. UmkmProductSeeder → Buat katalog produk UMKM (tidak ada dependency)
 *
 * Cara jalankan semua:
 * php artisan db:seed
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            DestinationSeeder::class,
            UmkmProductSeeder::class,
            OpenTripSeeder::class,
        ]);
    }
}
