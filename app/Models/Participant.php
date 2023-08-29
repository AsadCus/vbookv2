<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class, 'booking_id');
    }
}
