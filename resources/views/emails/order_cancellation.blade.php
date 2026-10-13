@component('emails.layout')
    <h2 style="font-family: Georgia, serif; font-size: 20px; color: #1E1E1E; margin-top: 0;">Order Cancellation</h2>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">Dear Patron,</p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Order <strong>{{ $order->order_number }}</strong> has been cancelled. Any collected funds will be returned to your original payment method.
    </p>
@endcomponent
