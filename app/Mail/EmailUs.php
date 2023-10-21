<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailUs extends Mailable
{
    use Queueable, SerializesModels;
    public $emailUs, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailUs, $subject)
    {
        $this->emailUs = $emailUs;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.mail.email_us')
            ->subject($this->subject);
    }
}
