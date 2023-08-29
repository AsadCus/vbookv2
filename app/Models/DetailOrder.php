<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function foodOrdering()
    {
        return $this->belongsTo(FoodOrdering::class, 'food_ordering_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
