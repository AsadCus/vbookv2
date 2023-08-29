<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            [
              'name' => 'Test Division',  
              'company_id' => 1,  
            ],
        ];
        foreach ($divisions as $key => $value) {
            Division::create($value);
        }
    }
}
