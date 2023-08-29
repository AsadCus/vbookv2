<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor_Room extends Model
{
    use HasFactory;
    protected $table = 'monitor__rooms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'room_id', 'booking_room_id'
    ];
}
