<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * Model: Documentation
 *
 * Mewakili arsip dokumentasi / galeri foto perjalanan rombongan
 * yang dikelola AW Tour Operator.
 *
 * Digunakan pada:
 * 1. Hero Section Showcase Preview Card di Beranda
 * 2. Halaman Publik Galeri (/gallery)
 * 3. Modul CRUD Admin (/admin/gallery)
 */
class Documentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'title',
        'description',
        'image_path',
        'trip_date',
        'participant_count',
        'badge_text',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'trip_date' => 'date',
        'participant_count' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Relasi ke Destinasi Wisata terkait.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Relasi ke Semua Item Media (Foto & Video) di Album Dokumentasi.
     */
    public function media()
    {
        return $this->hasMany(DocumentationMedia::class)->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Relasi khusus Foto.
     */
    public function photos()
    {
        return $this->hasMany(DocumentationMedia::class)->where('type', 'image')->orderBy('sort_order', 'asc');
    }

    /**
     * Relasi khusus Video.
     */
    public function videos()
    {
        return $this->hasMany(DocumentationMedia::class)->where('type', 'video')->orderBy('sort_order', 'asc');
    }

    /**
     * Accessor untuk URL Gambar Cover lengkap.
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path) {
            return asset('images/Bromo.jpg');
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        if (str_starts_with($this->image_path, 'images/')) {
            return asset($this->image_path);
        }

        return Storage::disk('public')->url($this->image_path);
    }

    /**
     * Scope: Hanya data yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Hanya data featured (unggulan).
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Urutkan berdasarkan sort_order atau latest.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->latest('id');
    }
}
