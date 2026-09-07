<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'basic_name',
        'basic_price',
        'basic_features',
        'standard_name',
        'standard_price',
        'standard_features',
        'premium_name',
        'premium_price',
        'premium_features',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
