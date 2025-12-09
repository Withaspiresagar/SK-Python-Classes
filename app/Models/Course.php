<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'price',
        'status',
        'duration_hours',
        'level',
        'what_you_will_learn',
        'requirements',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
