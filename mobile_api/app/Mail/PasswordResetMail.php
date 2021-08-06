<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $userid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token,$userid)
    {
        $this->token  = $token;
        $this->userid = $userid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')
        ->from(env('MAIL_USERNAME'))
        ->view('resetPasswordEmail');
    }
}
