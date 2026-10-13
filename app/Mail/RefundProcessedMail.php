<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RefundProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public Refund $refund) {}

    public function build()
    {
        return $this->subject("Refund Processed — {$this->order->order_number} | Modern Jewellery House")
                    ->view('emails.refund_processed');
    }
}
