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
    public $emailpin;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $emailList, $emailpin)
    {
        $this->data = $data;
        $this->emailList = $emailList;
        $this->emailpin = $emailpin;
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

        // foreach ($this->emailList as $mailist) {
        //     $email = new AddMailToMeeting($this->data);
        //     Mail::to($mailist)->send($email);
        //     sleep(5);
        // }



        $email = new AddMailToMeeting($this->data, $this->emailpin);
        Mail::to($this->emailList)->send($email);
        sleep(1);

        // Mail::to('faizo@gmail.com')->send($email);
    }
}
