<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
class GuestOrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $orderItems; // Change the property name to $orderItems

    /**
     * Create a new message instance.
     *
     * @param array $orderItems
     */
    public function __construct($orderItems) // Change the parameter name to $orderItems
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Guest Order Received')
                    ->view('mails.guest-order'); // Assuming you have a view file at 'resources/views/emails/guest_order_received.blade.php'
    }
}

