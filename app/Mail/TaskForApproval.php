<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskForApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $name)
    {
        $this->title = $title;
        $this->userName = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->userName;
        $taskTitle = $this->title;

        $address = "no-reply@kluss.be";
        $mailTitle = "KLUSS TEAM";
        $subject = "Uw klusje verwacht goedkeuring. | KLUSS";
        return $this->view('emails.approval', compact('user', 'taskTitle'))
                ->from($address, $mailTitle)
                ->replyTo($address, $mailTitle)
                ->subject($subject);
    }
}
