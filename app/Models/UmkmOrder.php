<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model: UmkmOrder
 *
 * Mewakili satu baris produk UMKM yang dipesan dalam sebuah custom request.
 * Tabel ini adalah "pivot dengan data tambahan" antara CustomRequest dan UmkmProduct.
 *
 * Mengapa menyimpan 'price_at_order'?
 * → Agar harga yang tercatat tidak berubah jika admin mengupdate harga produk
 *   di masa depan. Ini penting untuk histori & laporan.
 *
 * Relasi:
 * - belongsTo → CustomRequest (bagian dari request rombongan tertentu)
 * - belongsTo → UmkmProduct   (produk yang dipesan)
 */
class UmkmOrder extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'custom_request_id',
        'umkm_product_id',
        'quantity',
        'price_at_order',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'quantity'       => 'integer',
        'price_at_order' => 'integer',
    ];

    // ── Relasi ────────────────────────────────────────────────────────────

    /**
     * Order ini adalah bagian dari satu custom request.
     * Penggunaan: $order->customRequest
     */
    public function customRequest(): BelongsTo
    {
        return $this->belongsTo(CustomRequest::class);
    }

    /**
     * Order ini merujuk ke satu produk UMKM.
     * Penggunaan: $order->product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(UmkmProduct::class, 'umkm_product_id');
    }

    // ── Helper / Accessor ──────────────────────────────────────────────────

    /**
     * Hitung total harga untuk baris order ini.
     * Penggunaan: $order->subtotal
     * Contoh output: 150000 (quantity=3, price=50000)
     */
    public function getSubtotalAttribute(): int
    {
        return $this->quantity * $this->price_at_order;
    }

    /**
     * Format subtotal dalam Rupiah.
     * Penggunaan: $order->formatted_subtotal
     * Contoh output: "Rp 150.000"
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
