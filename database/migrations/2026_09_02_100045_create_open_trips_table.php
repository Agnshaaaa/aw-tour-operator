<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_open_trips_table
 *
 * Membuat tabel 'open_trips' — jadwal open trip publik.
 * Open trip adalah paket wisata dengan tanggal tetap yang bisa diikuti
 * oleh siapa saja (bukan rombongan khusus).
 * Berfungsi sebagai lead generator untuk AW Tour Operator.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('open_trips', function (Blueprint $table) {
            $table->id();

            // Relasi ke destinasi
            $table->foreignId('destination_id')
                  ->constrained('destinations')   // FK → destinations.id
                  ->restrictOnDelete();

            $table->string('title');                             // Judul trip (contoh: "Open Trip Bromo 3D2N")
            $table->date('departure_date');                      // Tanggal keberangkatan
            $table->date('return_date');                         // Tanggal kembali
            $table->unsignedSmallInteger('quota');               // Kuota peserta maksimal
            $table->unsignedSmallInteger('registered')->default(0); // Jumlah peserta terdaftar
            $table->unsignedInteger('price_per_person');         // Harga per orang (rupiah)
            $table->text('highlight')->nullable();               // Highlight singkat trip
            $table->enum('status', ['open', 'full', 'cancelled'])->default('open'); // Status trip
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('open_trips');
    }
};
