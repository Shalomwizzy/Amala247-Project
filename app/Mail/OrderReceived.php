<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $orderItems;

    /**
     * Create a new message instance.
     */
    public function __construct($orderItems)
    {
        $this->orderItems = $orderItems;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Amala247',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return (new Content)
            ->view('mails.order-received') // Use a view for the email content
            ->with('orderItems', $this->orderItems); // Pass the order items to the view
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

