<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    protected $fillable = [
        'class_name',
        'date',
        'time',
        'duration_minutes',
        'meeting_link',
        'batch_id',
        'status',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
