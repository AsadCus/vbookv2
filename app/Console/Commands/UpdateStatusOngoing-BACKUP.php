<?php

namespace App\Console\Commands;

use App\Models\BookingRoom;
use Illuminate\Console\Command;

class UpdateStatusOngoing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:ongoing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $statusBooking = 'waiting';
        $bookingOnGoing = BookingRoom::with('participant')->where('status_booking', 'waiting')->where('start_date', '<', now())->update(['status_booking' => 'ongoing']);

        // $participant = BookingRoom::with('participant')->where('status_booking', 'ongoing')->whereHas('participant', function ($q) use ($statusBooking) {
        //     return $q->where('status_booking', $statusBooking)->update(['status_booking' => 'ongoing']);
        // });
    }
}
