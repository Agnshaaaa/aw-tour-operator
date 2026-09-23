<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model: User
 *
 * Mewakili pengguna sistem — dalam konteks AW Tour Operator,
 * semua user adalah admin internal (tidak ada registrasi publik).
 * Kolom 'role' digunakan untuk membedakan level akses jika
 * di masa depan ada role tambahan (contoh: 'superadmin').
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara massal (mass assignment).
     * Penting: hanya kolom yang ada di sini yang bisa dipakai
     * lewat User::create([...]) atau $user->fill([...]).
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role',     // Ditambah: kolom dari migration add_role_to_users_table
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyikan saat data diubah ke JSON/array.
     * (contoh: saat return response()->json($user))
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe casting kolom — otomatis dikonversi saat diakses.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Helper Methods ────────────────────────────────────────────────────

    /**
     * Cek apakah user ini adalah admin.
     * Penggunaan: if ($user->isAdmin()) { ... }
     * Atau di Blade: @if(auth()->user()->isAdmin())
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
