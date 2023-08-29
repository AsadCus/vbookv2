<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDevice extends Model
{
    use HasFactory;

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
