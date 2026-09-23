<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model: BookedDate
 *
 * Menyimpan tanggal-tanggal yang sudah dipesan/diklaim oleh custom request.
 * Digunakan oleh Interactive Availability Calendar di halaman publik.
 * Admin bisa menambah/menghapus tanggal dari panel admin.
 *
 * Relasi:
 * - belongsTo → CustomRequest (tanggal ini diklaim oleh satu request)
 */
class BookedDate extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'custom_request_id',
        'booked_date',
        'label',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'booked_date' => 'date',   // Otomatis jadi Carbon date object
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Tanggal ini diklaim oleh satu custom request.
     * Penggunaan: $bookedDate->customRequest
     */
    public function customRequest(): BelongsTo
    {
        return $this->belongsTo(CustomRequest::class);
    }

    // ── Scope ─────────────────────────────────────────────────────────────

    /**
     * Ambil semua tanggal yang terpesan dalam rentang bulan tertentu.
     * Digunakan oleh calendar controller untuk render kalender.
     * Penggunaan: BookedDate::inMonth(2024, 9)->get()
     */
    public function scopeInMonth($query, int $year, int $month)
    {
        return $query->whereYear('booked_date', $year)
                     ->whereMonth('booked_date', $month);
    }
}
