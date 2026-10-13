<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public Payment $payment) {}

    public function build()
    {
        return $this->subject("Payment Verified — {$this->order->order_number} | Modern Jewellery House")
                    ->view('emails.payment_confirmation');
    }
}
