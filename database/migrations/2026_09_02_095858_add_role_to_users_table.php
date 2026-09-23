<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: add_role_to_users_table
 *
 * Menambahkan kolom 'role' ke tabel users.
 * Fungsi: Membedakan level akses pengguna di dalam sistem.
 * Nilai enum 'admin' = admin internal AW Tour Operator.
 * Default 'admin' karena tidak ada registrasi publik.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (tambah kolom).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kolom role: hanya nilai 'admin' yang valid untuk saat ini
            // Ditempatkan setelah kolom 'name'
            $table->enum('role', ['admin'])->default('admin')->after('name');
        });
    }

    /**
     * Batalkan migration (hapus kolom).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
