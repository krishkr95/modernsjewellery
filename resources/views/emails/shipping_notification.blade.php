@component('emails.layout')
    <h2 style="font-family: Georgia, serif; font-size: 20px; color: #1E1E1E; margin-top: 0;">Creation In Transit</h2>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">Dear Patron,</p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Your high jewellery creation for order <strong>{{ $order->order_number }}</strong> has departed our atelier in insured white-glove transit.
    </p>
    <p style="font-size: 13px; line-height: 1.6; color: #555555;">
        Tracking Number: <strong>{{ $order->tracking_number ?? 'ARMORED-SEC-'.strtoupper(substr(md5($order->id), 0, 8)) }}</strong>
    </p>
    <div style="margin: 30px 0; text-align: center;">
        <a href="{{ route('orders.track', $order->order_number) }}" style="background-color: #1E1E1E; color: #FFFFFF; padding: 12px 25px; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; display: inline-block;">Track Armored Transit</a>
    </div>
@endcomponent
