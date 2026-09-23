<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_umkm_products_table
 *
 * Membuat tabel 'umkm_products' — katalog produk oleh-oleh UMKM lokal.
 * Produk ini bisa dipilih klien sebagai add-on saat mengisi form quotation.
 * Contoh produk: Batik Surabaya, Keripik Tempe, dll.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('umkm_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                              // Nama produk UMKM
            $table->string('slug')->unique();                    // URL-friendly name
            $table->string('producer')->nullable();              // Nama UMKM/produsen
            $table->text('description')->nullable();             // Deskripsi produk
            $table->string('image')->nullable();                 // Foto produk
            $table->unsignedInteger('price');                    // Harga per unit (rupiah)
            $table->string('unit')->default('pcs');              // Satuan: pcs, box, kg, dll
            $table->boolean('is_available')->default(true);      // Tersedia/tidak tersedia
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_products');
    }
};
