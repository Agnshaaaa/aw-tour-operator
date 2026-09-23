<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeder: CategorySeeder
 *
 * Membuat 3 kategori layanan utama AW Tour Operator.
 * Kategori ini akan tampil di halaman publik sebagai highlight layanan.
 *
 * Cara jalankan:
 * php artisan db:seed --class=CategorySeeder
 */
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Studi Tour',
                'slug'        => 'studi-tour',
                'description' => 'Wisata edukatif untuk pelajar dan mahasiswa. '
                               . 'Menggabungkan perjalanan seru dengan kunjungan '
                               . 'ke tempat bersejarah, industri, dan pusat riset.',
                'icon'        => 'academic-cap',   // nama ikon Heroicons
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'name'        => 'Capacity Building',
                'slug'        => 'capacity-building',
                'description' => 'Program pengembangan SDM untuk institusi dan perusahaan. '
                               . 'Kombinasi pelatihan, outbound, dan team building '
                               . 'di destinasi wisata pilihan.',
                'icon'        => 'users-group',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'name'        => 'Family Gathering',
                'slug'        => 'family-gathering',
                'description' => 'Perjalanan wisata bersama keluarga besar atau karyawan. '
                               . 'Dirancang untuk mempererat hubungan dan menciptakan '
                               . 'kenangan indah bersama.',
                'icon'        => 'heart',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ CategorySeeder: 3 kategori layanan berhasil dibuat.');
    }
}
