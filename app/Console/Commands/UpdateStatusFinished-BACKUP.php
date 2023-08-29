<?php

namespace App\Console\Commands;

use App\Models\BookingRoom;
use Illuminate\Console\Command;

class UpdateStatusFinished extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:finished';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untuk Update Status Jika event telah selesai';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        // echo "Command untuk update status event selesai per menit";
        $bookingFinished = BookingRoom::where('status_booking', 'ongoing')->where('end_date', '<', now())->update(['status_booking' => 'finished']);
    }
}
