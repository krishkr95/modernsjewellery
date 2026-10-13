@component('emails.layout')
    <h2 style="font-family: Georgia, serif; font-size: 20px; color: #1E1E1E; margin-top: 0;">Order Confirmed</h2>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">Dear Patron,</p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Thank you for choosing Modern Jewellery House. We have received your acquisition order <strong>{{ $order->order_number }}</strong>.
    </p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Total: <strong>{{ $order->formatted_total }}</strong> | Expected Delivery: <strong>{{ $order->expected_delivery_at?->format('F d, Y') ?? '3-5 business days' }}</strong>
    </p>
    <div style="margin: 30px 0; text-align: center;">
        <a href="{{ route('orders.track', $order->order_number) }}" style="background-color: #1E1E1E; color: #FFFFFF; padding: 12px 25px; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; display: inline-block;">Track Your Order</a>
    </div>
@endcomponent
