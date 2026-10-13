@component('emails.layout')
    <h2 style="font-family: Georgia, serif; font-size: 20px; color: #1E1E1E; margin-top: 0;">Refund Processed</h2>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">Dear Patron,</p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        A refund of <strong>${{ number_format($refund->amount, 2) }}</strong> has been issued for order <strong>{{ $order->order_number }}</strong>.
    </p>
@endcomponent
