<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $subject)
    {
        $this->user = $user;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.mail.user_register_verification')
            ->subject($this->subject);
    }
}
