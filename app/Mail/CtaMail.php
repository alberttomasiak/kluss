<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CtaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $body, $btnSource, $btnTitle)
    {
        $this->title = $title;
        $this->body = $body;
        $this->btnSource = $btnSource;
        $this->btnTitle = $btnTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $btnSource = $this->btnSource;
        $title = $this->btnTitle;
        $body = $this->body;
        $btnTitle = $this->btnTitle;


        $address = 'no-reply@kluss.be';
        $name = 'Account Verification';
        $subject = 'Account verifiëren | KLUSS';
        return $this->view('emails.verification', compact('btnSource', 'title', 'body', 'btnTitle'))
                ->from($address, $name)
                ->replyTo($address, $name)
                ->subject($subject);
    }
}
