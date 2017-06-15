<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameFor, $nameAbout)
    {
        $this->nameFor = $nameFor;
        $this->nameAbout = $nameAbout;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nameFor = $this->nameFor;
        $nameAbout = $this->nameAbout;

        $address = "no-reply@kluss.be";
        $mailTitle = "KLUSS TEAM";
        $subject = "Review over ".$nameAbout." schrijven.";
        return $this->view('emails.review', compact('nameFor', 'nameAbout'))
                ->from($address, $mailTitle)
                ->replyTo($address, $mailTitle)
                ->subject($subject);
    }
}
