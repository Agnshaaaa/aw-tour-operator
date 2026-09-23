<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model: CustomRequest
 *
 * Model inti sistem booking — mewakili satu permintaan quotation
 * dari klien (kampus/sekolah/perusahaan) untuk wisata rombongan.
 *
 * Alur status:
 * pending → reviewed → quoted → confirmed
 *                             ↘ cancelled
 *
 * Relasi:
 * - belongsTo → Destination  (destinasi yang dipilih)
 * - hasMany   → BookedDate   (tanggal-tanggal yang diklaim)
 * - hasMany   → UmkmOrder    (add-on produk UMKM yang dipilih)
 */
class CustomRequest extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'destination_id',
        'ticket_number',
        'client_name',
        'institution_name',
        'phone',
        'email',
        'event_type',
        'event_date',
        'return_date',
        'pax',
        'transport_mode',
        'notes',
        'status',
        'admin_notes',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'event_date'  => 'date',
        'return_date' => 'date',
        'pax'         => 'integer',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Request ini menuju satu destinasi.
     * Penggunaan: $request->destination
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Request ini memiliki banyak tanggal yang dipesan.
     * Penggunaan: $request->bookedDates
     */
    public function bookedDates(): HasMany
    {
        return $this->hasMany(BookedDate::class);
    }

    /**
     * Request ini memiliki banyak order produk UMKM.
     * Penggunaan: $request->umkmOrders
     */
    public function umkmOrders(): HasMany
    {
        return $this->hasMany(UmkmOrder::class);
    }

    // ── Scope ─────────────────────────────────────────────────────────────

    /**
     * Hanya ambil request yang masih pending.
     * Penggunaan: CustomRequest::pending()->get()
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // ── Helper ────────────────────────────────────────────────────────────

    /**
     * Generate nomor tiket unik dengan format AW-YYYYMMDD-XXXX.
     * Contoh output: "AW-20240902-0001"
     *
     * Cara pakai di Controller:
     * $request->ticket_number = CustomRequest::generateTicketNumber();
     */
    public static function generateTicketNumber(): string
    {
        $date = now()->format('Ymd');
        // Hitung berapa request yang sudah ada hari ini, tambah 1
        $todayCount = static::whereDate('created_at', today())->count() + 1;
        return 'AW-' . $date . '-' . str_pad($todayCount, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Format nomor WhatsApp untuk redirect ke WhatsApp Admin.
     * Contoh output URL: "https://wa.me/6282233119092?text=..."
     */
    public function getWhatsappUrlAttribute(): string
    {
        $phone  = '6282233119092'; // Nomor admin AW Tour Operator
        $message = urlencode(
            "Halo Admin AW Tour Operator,\n" .
            "Saya {$this->client_name} dari {$this->institution_name}.\n" .
            "Nomor Tiket: {$this->ticket_number}\n" .
            "Destinasi: {$this->destination->name}\n" .
            "Tanggal: {$this->event_date->format('d M Y')}\n" .
            "Peserta: {$this->pax} orang\n\n" .
            "Mohon konfirmasi quotation kami. Terima kasih."
        );
        return "https://wa.me/{$phone}?text={$message}";
    }
}
