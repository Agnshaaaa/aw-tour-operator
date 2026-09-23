<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder: UserSeeder
 *
 * Membuat 2 akun admin awal untuk AW Tour Operator.
 * Data ini digunakan untuk login ke panel admin.
 *
 * Cara jalankan:
 * php artisan db:seed --class=UserSeeder
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin Utama ────────────────────────────────────────────────────
        User::create([
            'name'     => 'Admin AW Tour',
            'role'     => 'admin',
            'email'    => 'admin@awtour.com',
            'password' => Hash::make('admin123'),   // ⚠️ Ganti password setelah deploy!
        ]);

        // ── Admin Kedua ────────────────────────────────────────────────────
        User::create([
            'name'     => 'Admin Dua',
            'role'     => 'admin',
            'email'    => 'admin2@awtour.com',
            'password' => Hash::make('admin123'),   // ⚠️ Ganti password setelah deploy!
        ]);

        $this->command->info('✅ UserSeeder: 2 akun admin berhasil dibuat.');
    }
}
