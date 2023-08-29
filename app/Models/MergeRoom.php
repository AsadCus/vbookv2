<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MergeRoom extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function device1()
    {
        return $this->belongsTo(User::class, 'user_device1');
    }

    public function device2()
    {
        return $this->belongsTo(User::class, 'user_device2');
    }
}
