<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * Model: DocumentationMedia
 *
 * Mewakili item media (Foto / Video) dalam satu album dokumentasi rombongan.
 */
class DocumentationMedia extends Model
{
    use HasFactory;

    protected $table = 'documentation_media';

    protected $fillable = [
        'documentation_id',
        'type',
        'file_path',
        'caption',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Relasi ke Album Dokumentasi.
     */
    public function documentation(): BelongsTo
    {
        return $this->belongsTo(Documentation::class);
    }

    /**
     * Accessor untuk URL Media (Gambar / Video).
     */
    public function getUrlAttribute(): string
    {
        if (!$this->file_path) {
            return asset('images/Bromo.jpg');
        }

        // External Link (YouTube, Vimeo, Cloud Storage, dll)
        if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
            return $this->file_path;
        }

        // Local asset
        if (str_starts_with($this->file_path, 'images/')) {
            return asset($this->file_path);
        }

        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Helper untuk mendeteksi apakah YouTube video.
     */
    public function getIsYoutubeAttribute(): bool
    {
        return $this->type === 'video' && (
            str_contains($this->file_path, 'youtube.com') || 
            str_contains($this->file_path, 'youtu.be')
        );
    }

    /**
     * Accessor untuk YouTube Embed URL.
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (!$this->is_youtube) {
            return null;
        }

        $url = $this->file_path;
        $videoId = null;

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $matches)) {
            $videoId = $matches[1];
        }

        return $videoId ? "https://www.youtube.com/embed/{$videoId}?autoplay=1&rel=0" : $url;
    }
}
