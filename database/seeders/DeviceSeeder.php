<?php

namespace Database\Seeders;

use App\Models\CompanyDevice;
use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devices = [
            [
                'name' => 'd-pro-1',  
                'view' => 'PRO',  
                'type_device' => 'PRO',  
                'use_came' => 'NO',  
            ],
            [
                'name' => 'd-slim-1',  
                'view' => 'SLIM',  
                'type_device' => 'SLIM',  
                'use_came' => 'NO',  
            ],
        ];

        foreach ($devices as $key => $value) {
            Device::create($value);
        }

        $companyDevices = [
            [
                'company_id' => 1,
                'device_id' => 1,
            ],
            [
                'company_id' => 1,
                'device_id' => 2,
            ],
        ];

        foreach ($companyDevices as $key => $value) {
            CompanyDevice::create($value);
        }
    }
}
