<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model: UmkmProduct
 *
 * Mewakili produk UMKM lokal yang bisa dipilih klien sebagai add-on
 * ketika mengisi form quotation builder.
 * Contoh: Batik Surabaya, Keripik Tempe, Minuman Tradisional.
 *
 * Relasi:
 * - hasMany → UmkmOrder (produk ini ada di banyak order rombongan)
 */
class UmkmProduct extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'slug',
        'producer',
        'description',
        'image',
        'price',
        'unit',
        'is_available',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'price'        => 'integer',
        'is_available' => 'boolean',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Produk ini ada di banyak umkm_orders.
     * Penggunaan: $product->orders
     */
    public function orders(): HasMany
    {
        return $this->hasMany(UmkmOrder::class);
    }

    // ── Scope ─────────────────────────────────────────────────────────────

    /**
     * Hanya ambil produk yang tersedia.
     * Penggunaan: UmkmProduct::available()->get()
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    // ── Helper / Accessor ──────────────────────────────────────────────────

    /**
     * Format harga dalam format Rupiah.
     * Contoh output: "Rp 50.000 / pcs"
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.') . ' / ' . $this->unit;
    }
}
