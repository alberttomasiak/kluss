<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $btnSource = "verificatie/".$this->code;
        $title = "Account verifiëren";
        $body = "Hey! Je hebt u onlangs geregistreerd op KLUSS.be. Uw account moet nog wel geverifiëerd worden.";
        $btnTitle = "Verifiëren";


        $address = 'no-reply@kluss.be';
        $name = 'Account Verification';
        $subject = 'Account verifiëren | KLUSS';
        return $this->view('emails.verification', compact('btnSource', 'title', 'body', 'btnTitle'))
                ->from($address, $name)
                ->replyTo($address, $name)
                ->subject($subject);
    }
}
