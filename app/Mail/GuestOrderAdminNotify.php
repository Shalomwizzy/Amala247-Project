<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuestOrderAdminNotify extends Mailable
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
    

    public function build()
    {
        return $this->subject('New Order Notification')
                    ->view('mails.GuestOrderAdminNotify'); 
    }
}
