<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $primaryKey = 'id';

    public function foodCategory()
    {
        return $this->belongsTo(FoodCategory::class, 'food_categories_id');
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class, 'food_id');
    }
}
