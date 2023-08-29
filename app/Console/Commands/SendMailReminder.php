<?php

namespace App\Console\Commands;

use App\Mail\ReminderMeeting;
use App\Models\BookingRoom;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        // $newDateTime = Carbon::now()->addMinutes(10);

        // $bookingOnGoing = BookingRoom::with('participant')->where('status_booking', 'waiting')->where('start_date', '<', $newDateTime)->get();

        $bookingOnGoing = BookingRoom::with('participant')->where('status_booking', 'waiting')->get();




        // foreach ($bookingOnGoing as $getBooking) {
        //     $bookingDate = Carbon::parse($getBooking->start_date)->subMinute(10)->toDateTimeString();
        // }

        // $plus10minute =  strtotime("+600 seconds", $time);

        if ($bookingOnGoing->count() > 0) {

            // $currentDateTime = Carbon::now()->toDateTimeString();

            // $newDateTime = Carbon::now()->subMinute(10)->toDateTimeString();
            foreach ($bookingOnGoing as $bookingReminder) {
                $addMinutes = $bookingReminder->remainder_at;
                $newDateTime = Carbon::now()->addMinutes($addMinutes);
                $bookingOnGoing = BookingRoom::with('participant')->where('status_booking', 'waiting')->where('start_date', '<', $newDateTime)->get();
            }

            foreach ($bookingOnGoing as $getBooking) {
                $bookingDate = $getBooking->participant;
            }

            $sendMail = $bookingDate;

            foreach ($sendMail as $mail) {
                $send = $mail->email;

                foreach ($bookingOnGoing as $bookingNow) {
                    $data = ([
                        'email' => $mail->email,
                        'title' => $bookingNow->title,
                        'booking_id' => $bookingNow->id,
                        'remainder_at' => $bookingNow->remainder_at,

                    ]);
                }


                foreach ($bookingOnGoing as $booking) {
                    if ($booking->reminder == 'not') {
                        Mail::to($send)->send(new ReminderMeeting($data));
                    }
                    $stopSendMail = BookingRoom::where('status_booking', 'waiting')->where('start_date', '<', $newDateTime)->update(['reminder' => 'yes']);
                }
            }
        }

        return 0;
    }
}
