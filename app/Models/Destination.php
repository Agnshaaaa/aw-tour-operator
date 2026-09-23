<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model: Destination
 *
 * Mewakili destinasi wisata dalam katalog AW Tour Operator.
 * Ini adalah model inti yang digunakan di halaman katalog publik
 * dan form quotation builder.
 *
 * Relasi:
 * - belongsTo  → Category    (setiap destinasi masuk 1 kategori)
 * - hasOne     → DestinationDetail (detail lengkap destinasi)
 * - hasMany    → OpenTrip    (open trip yang tersedia di destinasi ini)
 * - hasMany    → CustomRequest (permintaan rombongan ke destinasi ini)
 */
class Destination extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'location',
        'short_description',
        'description',
        'cover_image',
        'min_price',
        'max_price',
        'min_pax',
        'is_featured',
        'is_active',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'min_price'   => 'integer',
        'max_price'   => 'integer',
        'min_pax'     => 'integer',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Destinasi ini milik satu kategori.
     * Penggunaan: $destination->category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Destinasi ini memiliki satu detail.
     * Penggunaan: $destination->detail
     */
    public function detail(): HasOne
    {
        return $this->hasOne(DestinationDetail::class);
    }

    /**
     * Destinasi ini memiliki banyak open trip.
     * Penggunaan: $destination->openTrips
     */
    public function openTrips(): HasMany
    {
        return $this->hasMany(OpenTrip::class);
    }

    /**
     * Destinasi ini memiliki banyak permintaan rombongan.
     * Penggunaan: $destination->customRequests
     */
    public function customRequests(): HasMany
    {
        return $this->hasMany(CustomRequest::class);
    }

    // ── Scope (Filter Query) ───────────────────────────────────────────────

    /**
     * Hanya ambil destinasi yang aktif.
     * Penggunaan: Destination::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Hanya ambil destinasi unggulan (untuk section homepage).
     * Penggunaan: Destination::featured()->get()
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // ── Helper / Accessor ──────────────────────────────────────────────────

    /**
     * Format harga dalam format Rupiah.
     * Penggunaan: $destination->formatted_price
     * Contoh output: "Mulai dari Rp 500.000"
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Mulai dari Rp ' . number_format($this->min_price, 0, ',', '.');
    }
}
