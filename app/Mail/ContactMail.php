<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactName;
    public $contactEmail;
    public $contactSubject;
    public $contactMessage;

    public function __construct($name, $email, $subject, $message)
    {
        $this->contactName = $name;
        $this->contactEmail = $email;
        $this->contactSubject = $subject;
        $this->contactMessage = $message;
    }

    public function build()
    {
        return $this
            ->subject($this->contactSubject)
            ->replyTo($this->contactEmail, $this->contactName)
            ->view('emails.contact');
    }
}