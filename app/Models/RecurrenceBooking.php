<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurrenceBooking extends Model
{
    use HasFactory;

    public function booking()
    {
        return $this->hasMany(BookingRoom::class, 'recurrence_booking_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
