<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model: OpenTrip
 *
 * Mewakili jadwal open trip publik — paket wisata dengan tanggal tetap.
 * Berbeda dengan custom request (rombongan privat), open trip terbuka
 * untuk umum dan memiliki kuota terbatas.
 * Berfungsi sebagai lead generator untuk menarik calon klien B2B.
 *
 * Relasi:
 * - belongsTo → Destination (open trip ini ke destinasi tertentu)
 */
class OpenTrip extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'destination_id',
        'title',
        'departure_date',
        'return_date',
        'quota',
        'registered',
        'price_per_person',
        'highlight',
        'status',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'departure_date'   => 'date',     // Otomatis jadi Carbon date object
        'return_date'      => 'date',
        'quota'            => 'integer',
        'registered'       => 'integer',
        'price_per_person' => 'integer',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Open trip ini menuju satu destinasi.
     * Penggunaan: $openTrip->destination
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    // ── Scope ─────────────────────────────────────────────────────────────

    /**
     * Hanya ambil open trip yang masih buka.
     * Penggunaan: OpenTrip::open()->get()
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Hanya ambil open trip yang akan datang (belum berlalu).
     * Penggunaan: OpenTrip::upcoming()->get()
     */
    public function scopeUpcoming($query)
    {
        return $query->where('departure_date', '>=', now()->toDateString());
    }

    // ── Helper ────────────────────────────────────────────────────────────

    /**
     * Hitung sisa kuota yang tersedia.
     * Penggunaan: $openTrip->available_slots
     */
    public function getAvailableSlotsAttribute(): int
    {
        return $this->quota - $this->registered;
    }

    /**
     * Hitung durasi trip dalam hari.
     * Contoh output: "3 Hari 2 Malam"
     */
    public function getDurationAttribute(): string
    {
        $days = $this->departure_date->diffInDays($this->return_date) + 1;
        $nights = $days - 1;
        return "{$days} Hari {$nights} Malam";
    }
}
