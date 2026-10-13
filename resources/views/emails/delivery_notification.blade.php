@component('emails.layout')
    <h2 style="font-family: Georgia, serif; font-size: 20px; color: #1E1E1E; margin-top: 0;">Creation Delivered</h2>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">Dear Patron,</p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Your creation for order <strong>{{ $order->order_number }}</strong> has arrived safely at your requested destination.
    </p>
@endcomponent
