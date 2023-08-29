<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->hasMany(User::class, 'company_id');
    }
    public function deviceCompany()
    {
        return $this->hasMany(CompanyDevice::class, 'company_id');
    }

    public function license()
    {
        return $this->belongsTo(Licence::class, 'licence_id');
    }
}
