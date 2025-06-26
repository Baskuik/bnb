<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BoekingBevestigingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $bevestigUrl;

    public function __construct(array $data, string $bevestigUrl)
    {
        $this->data = $data;
        $this->bevestigUrl = $bevestigUrl;
    }

    public function build()
    {
        return $this->subject('Bevestig je boeking')
                    ->view('emails.boeking_bevestiging') // Zorg dat dit view-bestand bestaat
                    ->with([
                        'data' => $this->data,
                        'bevestigUrl' => $this->bevestigUrl,
                    ]);
    }
}

