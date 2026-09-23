<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_destinations_table
 *
 * Membuat tabel 'destinations' — katalog destinasi wisata utama.
 * Setiap destinasi terhubung ke satu kategori (FK ke categories).
 * Digunakan di halaman katalog publik & form quotation builder.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel categories
            $table->foreignId('category_id')
                  ->constrained('categories')   // FK → categories.id
                  ->restrictOnDelete();          // Tidak bisa hapus kategori jika masih ada destinasi

            $table->string('name');                             // Nama destinasi (contoh: "Bromo Tengger Semeru")
            $table->string('slug')->unique();                   // URL: /destinations/bromo-tengger-semeru
            $table->string('location');                         // Lokasi kota/provinsi (contoh: "Malang, Jawa Timur")
            $table->text('short_description');                  // Deskripsi singkat (untuk card di katalog)
            $table->longText('description')->nullable();        // Deskripsi lengkap (halaman detail)
            $table->string('cover_image')->nullable();          // Path gambar utama
            $table->unsignedInteger('min_price')->default(0);   // Harga mulai dari (dalam rupiah)
            $table->unsignedInteger('max_price')->nullable();   // Harga maksimum (opsional)
            $table->unsignedSmallInteger('min_pax')->default(1); // Minimum peserta rombongan
            $table->boolean('is_featured')->default(false);     // Tampil di section unggulan homepage
            $table->boolean('is_active')->default(true);        // Aktif/nonaktif (toggle admin)
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
