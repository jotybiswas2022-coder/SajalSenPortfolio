<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company',
        'position',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'location',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'is_active'  => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function scopeActive($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Get duration string like "Jan 2020 - Present" or "Jan 2020 - Mar 2022"
     */
    public function getDurationAttribute(): string
    {
        $start = $this->start_date ? $this->start_date->format('M Y') : 'Unknown';
        $end = $this->is_current ? 'Present' : ($this->end_date ? $this->end_date->format('M Y') : 'Unknown');
        return $start . ' — ' . $end;
    }
}
