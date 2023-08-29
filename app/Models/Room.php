<?php

namespace App\Models;

use App\Models\BookingRoom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    

    public function user()
    {
        return $this->hasMany(User::class, 'room_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function bookingRoom()
    {
        return $this->hasMany(BookingRoom::class, 'room_id');
    }
   
    public function bookingRoomWait()
    {
        $now = \Carbon\Carbon::parse()->format('Y-m-d h:i:s');
        return $this->hasMany(BookingRoom::class, 'room_id')->where('status_booking', 'waiting');
    }

    public function bookingRoomOngo()
    {
        $now = \Carbon\Carbon::parse()->format('Y-m-d h:i:s');
        return $this->hasMany(BookingRoom::class, 'room_id')->where('status_booking', 'ongoing');
    }

    public function roomRestrict()
    {
        return $this->hasMany(RoomRestrict::class, 'room_id');
    }

    public function recurence()
    {
        return $this->hasMany(RecurrenceBooking::class, 'room_id');
    }
    
    public function apiRoom()
    {
        return $this->hasMany(ApiRoom::class, 'room_id');
    }
}
