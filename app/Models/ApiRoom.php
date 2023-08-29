<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiRoom extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public function api()
    {
        return $this->belongsTo(Api::class, 'api_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
