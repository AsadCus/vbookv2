<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'name' => 'Company1',
                'guest_access' => '93316254',
                'logo' => 'Company1_company_tes.png',
                'aplication_name' => 'booking-room-app',
                'licence_id' => 1,
            ],
        ];

        foreach ($companies as $key => $value) {
            Company::create($value);
        }
    }
}
