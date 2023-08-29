<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public function apiRoom()
    {
        return $this->hasMany(ApiRoom::class, 'api_id');
    }
}
