<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'company_name', 'profile_description', 'location', 'partners',
        'whatsapp_number', 'email', 'operational_hours',
    ];

    protected $casts = [
        'partners' => 'array',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'company_name' => 'AW Tour Operator',
                'profile_description' => 'Spesialis Group Customized Tour Operator di Surabaya. Melayani Studi Tour, Capacity Building, dan Family Gathering.',
                'location' => 'Surabaya, Jawa Timur',
                'partners' => ['ITS Surabaya', 'UNAIR', 'UNESA', 'Instansi Swasta'],
                'whatsapp_number' => '6282233119092',
                'email' => null,
                'operational_hours' => 'Senin - Sabtu (08.00 - 17.00 WIB)',
            ]
        );
    }

    public function getWhatsappUrlAttribute(): string
    {
        $number = preg_replace('/\\D+/', '', (string) $this->whatsapp_number);

        return 'https://wa.me/' . $number;
    }
}
