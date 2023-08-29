<?php

namespace App\Console\Commands;

use App\Models\BookingRoom;
use App\Models\Participant;
use Illuminate\Console\Command;

class UpdateStatusPaticipant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participant:ongoing';

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
        $bookingOnGoing = BookingRoom::with('participant')->where('status_booking', 'ongoing')->get();

        foreach ($bookingOnGoing as $bookingId) {
            $getId = $bookingId->id;
            $participant = Participant::where('booking_id', $getId)->where('status_booking', 'waiting')->update(['status_booking' => 'ongoing']);
        }
    }
}
