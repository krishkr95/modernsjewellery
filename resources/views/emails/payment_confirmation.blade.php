@component('emails.layout')
    <h2 style="font-family: Georgia, serif; font-size: 20px; color: #1E1E1E; margin-top: 0;">Payment Verified</h2>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">Dear Patron,</p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Your payment of <strong>{{ $order->formatted_total }}</strong> for order <strong>{{ $order->order_number }}</strong> has been verified successfully via Razorpay.
    </p>
    <p style="font-size: 12px; color: #777777;">Reference: {{ $payment->payment_reference }}</p>
    <div style="margin: 30px 0; text-align: center;">
        <a href="{{ route('orders.track', $order->order_number) }}" style="background-color: #1E1E1E; color: #FFFFFF; padding: 12px 25px; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; display: inline-block;">View Order Dossier</a>
    </div>
@endcomponent
