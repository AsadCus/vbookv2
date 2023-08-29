<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddMailToMeeting extends Mailable
{
    use Queueable, SerializesModels;


    public $data;
    public $emailpin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $emailpin)
    {
        $this->data = $data;
        $this->emailpin = $emailpin;
    }


    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $subject = 'Undangan Meeting';
        return $this->view('email-template.add-to-meet')->subject($subject);
    }
}
