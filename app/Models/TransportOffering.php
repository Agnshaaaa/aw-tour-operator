<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TransportOffering extends Model
{
    protected $fillable = [
        'name', 'slug', 'display_group', 'capacity', 'price_label',
        'description', 'features', 'image', 'unit_count', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'unit_count' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeVehicles(Builder $query): Builder
    {
        return $query->where('display_group', 'vehicle');
    }

    public function scopeBodyTypes(Builder $query): Builder
    {
        return $query->where('display_group', 'body_type');
    }
}
