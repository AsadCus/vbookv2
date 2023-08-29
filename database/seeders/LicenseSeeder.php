<?php

namespace Database\Seeders;

use App\Models\Licence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Licence::create([
            'code' => 'RA3T-G1ND-HX54-PMJ9',
            'max_device' => 3,
            'count_device' => 2,
        ]);
    }
}
