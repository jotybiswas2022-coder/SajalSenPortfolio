<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'image',
        'phone',
        'email',
        'cv',
        'github',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'fiverr',
        'upwork',
        'freelancer',
    ];
}
