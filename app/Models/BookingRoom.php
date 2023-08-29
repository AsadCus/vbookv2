<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingRoom extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function participant()
    {
        return $this->hasMany(Participant::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recurrence()
    {
        return $this->belongsTo(RecurrenceBooking::class, 'recurrence_booking_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'department');
    }
}
