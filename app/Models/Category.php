<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model: Category
 *
 * Mewakili kategori layanan tour.
 * Contoh: Studi Tour, Capacity Building, Family Gathering.
 *
 * Relasi:
 * - hasMany → Destination (satu kategori punya banyak destinasi)
 */
class Category extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Satu kategori memiliki banyak destinasi.
     * Penggunaan: $category->destinations
     */
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }

    // ── Scope (Filter Query) ───────────────────────────────────────────────

    /**
     * Hanya ambil kategori yang aktif.
     * Penggunaan: Category::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Urutkan berdasarkan sort_order (untuk tampilan homepage).
     * Penggunaan: Category::ordered()->get()
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
