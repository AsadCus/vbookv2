<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddMailToMeeting;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    public $emailList;
    public $emailOrganizer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $emailList, $emailOrganizer)
    {
        $this->data = $data;
        $this->emailList = $emailList;
        $this->emailOrganizer = $emailOrganizer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // foreach ($this->data as $mail) {
        //     $email = new AddMailToMeeting($this->data);
        //     Mail::to($mail->email)->send($email);
        // }

        // $getMail = json_decode($this->emailList);

        // foreach ($getMail as $mail) {
        //     Mail::to($mail)->send(new AddMailToMeeting($this->data));
        // }



        $email = new AddMailToMeeting($this->data);
        Mail::to($this->emailList, $this->emailOrganizer)->send($email);
        // Mail::to('faizo@gmail.com')->send($email);
    }
}
