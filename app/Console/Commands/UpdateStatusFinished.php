<?php

namespace App\Console\Commands;

use App\Models\BookingRoom;
use Carbon\Carbon;
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
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addSeconds(30);
        // return Command::SUCCESS;
        // echo "Command untuk update status event selesai per menit";
        $bookingFinished = BookingRoom::where('status_booking', 'ongoing')->where('end_date', '<', $newDateTime)->update(['status_booking' => 'finished']);
    }
}
