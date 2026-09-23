<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: create_custom_requests_table
 *
 * Membuat tabel 'custom_requests' — inti dari sistem booking rombongan.
 * Setiap baris mewakili satu permintaan quotation dari klien (kampus/perusahaan).
 * Data ini dihasilkan dari form multi-step quotation builder di halaman publik.
 * Admin melihat dan mengelola semua request dari panel admin.
 */
return new class extends Migration
{
    /**
     * Jalankan migration (buat tabel).
     */
    public function up(): void
    {
        Schema::create('custom_requests', function (Blueprint $table) {
            $table->id();

            // Relasi ke destinasi yang dipilih klien
            $table->foreignId('destination_id')
                  ->constrained('destinations')   // FK → destinations.id
                  ->restrictOnDelete();

            // ── Nomor Tiket ─────────────────────────────────────────────
            // Format: AW-YYYYMMDD-XXXX (contoh: AW-20240902-0001)
            $table->string('ticket_number')->unique();

            // ── Identitas Klien ──────────────────────────────────────────
            $table->string('client_name');           // Nama PIC / penanggung jawab
            $table->string('institution_name');      // Nama kampus/sekolah/perusahaan
            $table->string('phone');                 // Nomor WhatsApp klien
            $table->string('email')->nullable();     // Email (opsional)

            // ── Detail Acara ─────────────────────────────────────────────
            $table->string('event_type');            // Jenis acara: Studi Tour, Capacity Building, dll
            $table->date('event_date');              // Tanggal acara yang diinginkan
            $table->date('return_date')->nullable(); // Tanggal kembali (untuk multi-hari)
            $table->unsignedSmallInteger('pax');     // Estimasi jumlah peserta
            $table->string('transport_mode');        // Moda transportasi: Bus, Kereta, Pesawat

            // ── Catatan & Status ─────────────────────────────────────────
            $table->text('notes')->nullable();       // Catatan/permintaan khusus dari klien
            $table->enum('status', [
                'pending',      // Baru masuk, belum diproses admin
                'reviewed',     // Sudah ditinjau admin
                'quoted',       // Penawaran harga sudah dikirim
                'confirmed',    // Klien konfirmasi setuju
                'cancelled',    // Dibatalkan
            ])->default('pending');

            $table->text('admin_notes')->nullable(); // Catatan internal admin
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_requests');
    }
};
