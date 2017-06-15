<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KlussGoldPurchase extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $end_date)
    {
        $this->name = $name;
        $this->end_date = $end_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $end_date = $this->end_date;
        $user = $this->name;

        $address = "no-reply@kluss.be";
        $mailTitle = "KLUSS TEAM";
        $subject = "KLUSS Gold aangeschaft";
        return $this->view('emails.gold', compact('user', 'end_date'))
                ->from($address, $mailTitle)
                ->replyTo($address, $mailTitle)
                ->subject($subject);
    }
}
