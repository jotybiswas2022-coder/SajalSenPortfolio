<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable = [
        'title',
        'client',
        'category',
        'problem',
        'solution',
        'result',
        'image',
        'technologies',
        'url',
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

    public function getTechListAttribute(): array
    {
        return $this->technologies
            ? array_map('trim', explode(',', $this->technologies))
            : [];
    }
}
