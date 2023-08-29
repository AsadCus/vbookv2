<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->hasMany(Room::class, 'device_id');
    }



    public function deviceCompany()
    {
        return $this->hasMany(CompanyDevice::class, 'device_id');
    }
}
