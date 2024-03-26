<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class NuevoPostCorreo extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;

    public function __construct($mailData) 
    {
        $this->mailData = $mailData;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva publicación en el blog de los Riders',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.correoRiders', 
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
