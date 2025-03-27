<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddUserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    
    public function __construct($content)
    {
        $this->content = $content;
    }

    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sikeres felvétel',
        );
    }

   
    public function content(): Content
    {
        return new Content(
            view: 'adusermail',
        );
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
