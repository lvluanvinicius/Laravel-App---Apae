<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Complaints extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Guarda os dados do corpo do e-mail.
     *
     * @var array
     */
    public array $data_send;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data_send)
    {
        $this->data_send = $data_send;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'components.mails.complaints',
            with: [
                'data' => $this->data_send
            ]
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