<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    protected $fillable = [
        'class_name',
        'date',
        'time',
        'meeting_link',
        'course_id',
        'status',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
