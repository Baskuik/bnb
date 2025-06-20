<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BoekingBevestiging extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Hierin zitten alle gegevens

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Bevestiging van je boeking')
                    ->markdown('emails.boeking');
    }
}


