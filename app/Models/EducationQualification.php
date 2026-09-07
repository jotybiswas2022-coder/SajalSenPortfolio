<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationQualification extends Model
{
    protected $fillable = [
        'degree_name',
        'institution',
        'board_or_university',
        'duration',
        'result',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', true)->orderBy('display_order');
    }
}
