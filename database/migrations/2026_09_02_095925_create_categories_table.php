<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_categories_table
 *
 * Membuat tabel 'categories' untuk mengkategorikan layanan tour.
 * Contoh kategori: Studi Tour, Capacity Building, Family Gathering.
 * Digunakan untuk mengelompokkan destinasi & paket di halaman publik.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();                                           // Primary key auto-increment
            $table->string('name');                                 // Nama kategori (contoh: "Studi Tour")
            $table->string('slug')->unique();                       // URL-friendly name (contoh: "studi-tour")
            $table->text('description')->nullable();                // Deskripsi singkat kategori
            $table->string('icon')->nullable();                     // Nama ikon (misal: dari heroicons/fontawesome)
            $table->unsignedTinyInteger('sort_order')->default(0); // Urutan tampil di halaman (0 = pertama)
            $table->boolean('is_active')->default(true);            // Aktif/nonaktif (toggle dari admin)
            $table->timestamps();                                   // created_at & updated_at (otomatis Laravel)
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
