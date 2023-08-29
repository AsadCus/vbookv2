<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodOrdering extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class, 'booking_id');
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class, 'food_ordering_id');
    }

    // public function food()
    // {
    //     return $this->belongsTo(Food::class, 'food_id');
    // }
}
