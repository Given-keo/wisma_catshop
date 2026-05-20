<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    protected $fillable = [
        'booking_code', 'user_id', 'cat_id', 'service_id', 
        'start_date', 'end_date', 'total_price', 'down_payment', 
        'brought_items', 'status', 'is_walk_in', 'is_reward_claimed',
        'payment_proof',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cat()
    {
        return $this->belongsTo(Cats::class, 'cat_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function boardingLogs()
    {
        return $this->hasMany(BoardingLog::class);
    }
}