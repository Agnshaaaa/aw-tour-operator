<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_destination_details_table
 *
 * Membuat tabel 'destination_details' — informasi detail per destinasi.
 * Dipisah dari tabel 'destinations' agar tabel utama tetap ringan.
 * Berisi itinerary, fasilitas, dan galeri foto.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('destination_details', function (Blueprint $table) {
            $table->id();

            // Relasi one-to-one ke tabel destinations
            $table->foreignId('destination_id')
                  ->unique()                        // Satu destinasi hanya punya satu detail
                  ->constrained('destinations')     // FK → destinations.id
                  ->cascadeOnDelete();              // Hapus detail otomatis jika destinasi dihapus

            $table->json('itinerary')->nullable();       // Rencana perjalanan per hari (format JSON)
            $table->json('inclusions')->nullable();      // Yang sudah termasuk dalam paket (JSON array)
            $table->json('exclusions')->nullable();      // Yang belum termasuk dalam paket (JSON array)
            $table->json('gallery_images')->nullable();  // Array path foto galeri (JSON array)
            $table->text('notes')->nullable();           // Catatan tambahan / syarat & ketentuan
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_details');
    }
};
