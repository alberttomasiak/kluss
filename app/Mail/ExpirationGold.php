<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpirationGold extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $diff)
    {
        $this->name = $name;
        $this->diff = $diff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $diff = $this->diff;
        $user = $this->name;

        $address = "no-reply@kluss.be";
        $mailTitle = "KLUSS TEAM";
        $subject = "Uw KLUSS Gold subscriptie is bijna verlopen.";
        return $this->view('emails.goldExpired', compact('user', 'diff'))
                ->from($address, $mailTitle)
                ->replyTo($address, $mailTitle)
                ->subject($subject);
    }
}
