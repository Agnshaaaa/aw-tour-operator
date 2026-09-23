<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_booked_dates_table
 *
 * Membuat tabel 'booked_dates' — menyimpan tanggal-tanggal yang sudah terpesan.
 * Digunakan oleh Interactive Availability Calendar di halaman publik.
 * Tanggal ditandai merah (fully booked) atau hijau (tersedia).
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('booked_dates', function (Blueprint $table) {
            $table->id();

            // Relasi ke custom_request yang mengklaim tanggal ini
            $table->foreignId('custom_request_id')
                  ->constrained('custom_requests')  // FK → custom_requests.id
                  ->cascadeOnDelete();               // Hapus booking date jika request dihapus

            $table->date('booked_date');             // Tanggal yang terpesan
            $table->string('label')->nullable();     // Label opsional untuk admin (contoh: "ITS Studi Tour")
            $table->timestamps();

            // Index agar query kalender lebih cepat
            $table->index('booked_date');
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_dates');
    }
};
