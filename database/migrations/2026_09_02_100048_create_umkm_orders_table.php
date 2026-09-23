<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_umkm_orders_table
 *
 * Membuat tabel 'umkm_orders' — produk UMKM yang dipilih klien sebagai add-on.
 * Tabel ini menghubungkan custom_request dengan umkm_products (pivot/relasi many-to-many).
 * Setiap baris = satu jenis produk UMKM yang dipesan dalam satu request rombongan.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('umkm_orders', function (Blueprint $table) {
            $table->id();

            // Relasi ke permintaan rombongan
            $table->foreignId('custom_request_id')
                  ->constrained('custom_requests')  // FK → custom_requests.id
                  ->cascadeOnDelete();               // Hapus order jika request dihapus

            // Relasi ke produk UMKM yang dipesan
            $table->foreignId('umkm_product_id')
                  ->constrained('umkm_products')    // FK → umkm_products.id
                  ->restrictOnDelete();              // Tidak bisa hapus produk jika ada di order

            $table->unsignedSmallInteger('quantity');            // Jumlah unit yang dipesan
            $table->unsignedInteger('price_at_order');           // Harga saat dipesan (snapshot harga)
                                                                 // Disimpan sendiri agar tidak berubah
                                                                 // jika harga produk diupdate di masa depan
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_orders');
    }
};
