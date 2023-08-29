<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'    => 'SUPER ADMIN',
                'email'    => 'superadmin@gmail.com',
                'username'    => 'superadmin@gmail.com',
                'no_telp'    => '000000000000',
                'role_id'    => 1,
                'password'    => Hash::make(12345678),
            ],
            [
                'name' => 'Company1',
                'role_id'    => 2,
                'company_id'    => 1,
                'email' => 'company1@gmail.com',
                'username' => 'company1@gmail.com',
                'no_telp' => '000000000000',
                'licence_id' => 1,
                'password'    => Hash::make(12345678),
            ],
            [
                'name' => 'Pantry',
                'role_id'    => 7,
                'company_id'    => 1,
                'email' => 'pantry@gmail.com',
                'username' => 'pantry@gmail.com',
                'no_telp' => '000000000000',
                'licence_id' => 1,
                'password'    => Hash::make(12345678),
            ],
            [
                'name' => 'Device_room1',
                'room_id' => 1,
                'role_id'    => 4,
                'device_merge'    => 1,
                'email' => 'device_room1@gmail.com',
                'username' => 'room1@gmail.com',
                'ip_address_merge_room' => '192.168.100.100',
                'password'    => Hash::make(12345678),
                'pin' => 210453,
            ],
            [
                'name' => 'Device_room2',
                'room_id' => 2,
                'role_id'    => 4,
                'device_merge'    => 2,
                'email' => 'device_room2@gmail.com',
                'username' => 'room2@gmail.com',
                'ip_address_merge_room' => '192.168.100.100',
                'password'    => Hash::make(12345678),
                'pin' => 528462,
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
