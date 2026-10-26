<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'company_name', 'site_title', 'hero_heading', 'hero_subheading',
        'profile_description', 'location', 'partners',
        'whatsapp_number', 'email', 'operational_hours', 'footer_text',
    ];

    protected $casts = [
        'partners' => 'array',
    ];

    public static function current(): self
    {
        $setting = static::query()->firstOrCreate(
            ['id' => 1],
            [
                'company_name' => 'AW Tour Operator',
                'site_title' => 'AW Tour Operator Surabaya',
                'hero_heading' => 'Wujudkan Perjalanan Rombongan Impian bersama AW Tour Operator',
                'hero_subheading' => 'Spesialis Group Customized Tour di Surabaya. Melayani Studi Tour, Capacity Building, Family Gathering dengan itinerary 100% custom sesuai kebutuhan rombongan Anda.',
                'profile_description' => 'Spesialis Group Customized Tour Operator di Surabaya. Melayani Studi Tour, Capacity Building, dan Family Gathering.',
                'location' => 'Jl. Pakis No.30A, Surabaya, Jawa Timur',
                'partners' => ['ITS Surabaya', 'UNAIR', 'UNESA', 'Instansi Swasta'],
                'whatsapp_number' => '6282233119092',
                'email' => null,
                'operational_hours' => 'Senin - Sabtu (08.00 - 17.00 WIB)',
                'footer_text' => 'AW Tour Operator Surabaya. All rights reserved.',
            ]
        );

        if ($setting->location === 'Surabaya, Jawa Timur' || empty($setting->location)) {
            $setting->update(['location' => 'Jl. Pakis No.30A, Surabaya, Jawa Timur']);
        }

        return $setting;
    }

    public function getWhatsappUrlAttribute(): string
    {
        $number = preg_replace('/\\D+/', '', (string) $this->whatsapp_number);

        return 'https://wa.me/' . $number;
    }
}
