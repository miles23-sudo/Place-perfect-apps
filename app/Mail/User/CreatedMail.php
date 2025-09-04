<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $raw_password;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $raw_password)
    {
        $this->user = $user;
        $this->raw_password = $raw_password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Created Mail | ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.user.created-mail',
            with: [
                'user' => $this->user,
                'raw_password' => $this->raw_password,
            ]
        );
    }
}
