<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'log_date',
        'eating_condition',
        'activity',
        'photo_path',
        'health_notes',
    ];

    protected $casts = [
        'log_date' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}