<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskDenied extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $name, $reason)
    {
        $this->title = $title;
        $this->name = $name;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = $this->title;
        $user = $this->name;
        $reason = $this->reason;

        $address = "no-reply@kluss.be";
        $mailTitle = "KLUSS TEAM";
        $subject = "Uw klusje werd afgekeurd | KLUSS";
        return $this->view('emails.denied', compact('user', 'title', 'reason'))
                ->from($address, $mailTitle)
                ->replyTo($address, $mailTitle)
                ->subject($subject);
    }
}
