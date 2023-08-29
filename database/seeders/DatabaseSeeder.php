<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\superadmin\DeviceController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(LicenseSeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(BookingRoomSeeder::class);
        $this->call(FoodSeeder::class);
    }
}
