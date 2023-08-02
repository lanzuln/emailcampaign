<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class promotionalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $msg;

    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->msg = $message;
    }


    public function build()
    {  
        return $this->subject($this->subject)
                    ->view('email.promotionalEmailTemplate');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}