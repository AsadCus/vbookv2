<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\BookingRoom;
use App\Models\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookingRooms = [
            [
                'title' => 'Meeting Seeder',  
                'description' => 'oke',
                'user_id' => 2,
                'company_id' => 1,
                'room_id' => 1,
                'department' => 1,
                'date' => Carbon::now()->format('Y-m-d'),
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s'),
                'status' => 1,
                'status_booking' => 'waiting',
                'reminder' => 'not',
                'reload' => 1,
                'reload_device2' => 1,
                'remainder_at' => 5,
            ],
        ];

        foreach ($bookingRooms as $key => $value) {
            BookingRoom::create($value);
        }

        $participants = [
            [
                'booking_id' => 1,  
                'email' => 'company1@gmail.com',
                'participant_confirmation' => 1,
                'status_booking' => 'waiting',
                'pin' => 7868,
            ],
        ];

        foreach ($participants as $key => $value) {
            Participant::create($value);
        }
    }
}
