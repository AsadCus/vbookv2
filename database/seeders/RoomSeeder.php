<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'name' => 'room1',
                'company_id' => 1,
                'capacity' => 9,
                'floor' => 2,
                'ip_address' => '192.168.100.100',
                'color_code' => '#07a82c',
                'device_id' => 1,
                'projector' => 1,
                'internet' => 1,
                'taphome_on' => null,
                'taphome_off' => null,
            ],
            [
                'name' => 'room2',
                'company_id' => 1,
                'capacity' => 9,
                'floor' => 2,
                'ip_address' => '192.168.100.100',
                'color_code' => '#ff9b29',
                'device_id' => 2,
                'projector' => 1,
                'internet' => 1,
                'taphome_on' => 'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/3?token=439658ab-9fc9-439b-a156-116148b10152&valueTypeId=48&value=1',
                'taphome_off' => 'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/3?token=439658ab-9fc9-439b-a156-116148b10152&valueTypeId=48&value=0',
            ],
        ];

        foreach ($rooms as $key => $value) {
            Room::create($value);
        }
    }
}
