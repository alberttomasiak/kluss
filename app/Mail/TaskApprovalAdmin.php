<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskApprovalAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $title, $description)
    {
        $this->email = $email;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->email;
        $title = $this->title;
        $description = $this->description;

        $address = "no-reply@kluss.be";
        $mailTitle = "Goedkeuring Klus";
        $subject = "Een nieuw klusje verwacht goedkeuring! | KLUSS";
        return $this->view('emails.approvalAdmin', compact('user', 'title', 'description'))
                ->from($address, $mailTitle)
                ->replyTo($address, $mailTitle)
                ->subject($subject);
    }
}
