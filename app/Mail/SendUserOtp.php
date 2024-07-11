<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserOtp extends Mailable
{
    use Queueable, SerializesModels;
    public $userOtp;

    /**
     * Create a new message instance.
     */
    public function __construct($userOtp)
    {
        $this->userOtp = $userOtp;
    }
    
    /**
     * Get the message envelope.
     */
    public function build()
    {
        
        return $this->markdown('emails.senduserOtp')->with('userOtp', $this->userOtp);

    }
}
