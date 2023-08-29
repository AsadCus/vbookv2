<?php

namespace Database\Seeders;

use App\Models\DetailOrder;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\FoodOrdering;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Minuman',  
                'company_id' => 1,
            ],
            [
                'name' => 'Buah',  
                'company_id' => 1, 
            ],
        ];

        foreach ($categories as $key => $value) {
            FoodCategory::create($value);
        }

        $foods = [
            [
                'food_menu' => 'Es Teh Manis',  
                'food_categories_id' => 1,
                'foto_menu' => 'Taro_chilldogo.jpg',
                'company_id' => 1,
            ],
            [
                'food_menu' => 'Apel',  
                'food_categories_id' => 2,
                'foto_menu' => 'Taro_chilldogo.jpg',
                'company_id' => 1, 
            ],
        ];

        foreach ($foods as $key => $value) {
            Food::create($value);
        }

        $foodOrderings = [
            [
                'booking_id' => 1,
                'status' => 'inprocess',
            ],
        ];

        foreach ($foodOrderings as $key => $value) {
            FoodOrdering::create($value);
        }
        
        $detailOrders = [
            [
                'food_ordering_id' => 1,
                'food_id' => 1,
                'pieces' => 1,
            ],
            [
                'food_ordering_id' => 1,
                'food_id' => 2,
                'pieces' => 1,
            ],
        ];

        foreach ($detailOrders as $key => $value) {
            DetailOrder::create($value);
        }
    }
}
