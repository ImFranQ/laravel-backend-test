<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Email;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * The email instance.
     *
     * @var \App\Models\Email
     */
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(['address' => $this->email->user->email, 'name' => $this->email->user->getFullName()])
            ->subject($this->email->subject)
            ->view('templates.emails.email');
    }
}
