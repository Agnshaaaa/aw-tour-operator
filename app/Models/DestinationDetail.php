<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model: DestinationDetail
 *
 * Menyimpan informasi detail lengkap dari sebuah destinasi.
 * Dipisah dari tabel 'destinations' agar tabel utama tetap ringan
 * dan halaman daftar/katalog tidak perlu memuat data berat ini.
 *
 * Kolom JSON (itinerary, inclusions, exclusions, gallery_images)
 * otomatis di-cast ke array PHP saat diakses.
 *
 * Relasi:
 * - belongsTo → Destination (milik satu destinasi)
 */
class DestinationDetail extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'destination_id',
        'itinerary',
        'inclusions',
        'exclusions',
        'gallery_images',
        'notes',
    ];

    /**
     * Casting tipe data kolom.
     * Kolom JSON otomatis dikonversi ke PHP array saat dibaca,
     * dan sebaliknya saat disimpan ke database.
     */
    protected $casts = [
        'itinerary'      => 'array',  // Rencana perjalanan per hari
        'inclusions'     => 'array',  // Yang termasuk dalam paket
        'exclusions'     => 'array',  // Yang tidak termasuk
        'gallery_images' => 'array',  // Daftar path foto galeri
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Detail ini milik satu destinasi.
     * Penggunaan: $detail->destination
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
