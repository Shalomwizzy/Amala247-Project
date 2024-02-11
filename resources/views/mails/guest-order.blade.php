
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Received</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .order-received {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .shipping-address {
            margin-top: 30px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th, .order-details td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-info img {
            max-width: 50px; /* Adjust the size as needed */
            margin-right: 10px;
        }

        .mail-social-media {
            background-color: red;
            color: white;
            padding: 8px;
            text-align: center;
        }

        .mail-social-media a {
            text-decoration: none;
            color: white !important;
            padding: 10px;
            font-size: 16px;
        }

        .mail-social-media i {
            font-size: 18px;
        }

        .mail-social-media .mail-facebook {
            color: blue;
        }

        .mail-social-media .mail-instagram {
            color: #f09433;
        }

        .mail-social-media .mail-twitter {
            color: black !important;
        }

        .mail-social-media .mail-whatsapp {
            color: green !important;
        }

        .customer-service {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .customer-service a {
            text-decoration: underline !important;
            color: blue !important;
        }

        .office-address {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="order-received">
            <!-- Header with Amala 247 logo -->
            <img src="{{ asset('images/main logo-edit.png') }}" width="90" alt="Amala 247 Logo" class="img-fluid">

            <!-- Greeting and Appreciation -->
            @if(isset($orderItems->first()->guest))
                <h3>DEAR {{ $orderItems->first()->guest->first_name ?? 'GUEST' }},</h3>
                <p>Thank you for choosing Amala 247. We appreciate your patronage!</p>

                <!-- Shipping Address -->
                <div class="shipping-address">
                    <h5>Shipping Address:</h5>
                    <p>
                        {{ optional($orderItems->first()->guest)->street_address ?? '' }},
                        {{ optional($orderItems->first()->guest)->house_number ?? '' }},
                        {{ optional($orderItems->first()->guest)->city ?? '' }},
                        {{ optional($orderItems->first()->guest)->state ?? '' }}
                    </p>
                    <p>Your order will be delivered to the above address.</p>
                </div>
            @else
                <!-- Handle user case here if needed -->
            @endif

            <!-- Order ID and Tracking Information -->
            <div>
                <p><strong>Order ID:</strong> {{ $orderItems->first()->order_id }}</p>
                <p>Click <a href="{{ route('order.track') }}"> here</a> to track the status of your order with your order id</p>
            </div>

            <!-- Order Details -->
            <div class="order-details">
                <h5>Order Details:</h5>

                @if (collect($orderItems)->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orderItems->unique('product_id') as $item)
                                <tr>
                                    <td class="product-info">
                                        <img src="{{ asset($item->product->product_image) }}" alt="{{ $item->product->product_name }}" class="img-fluid">
                                        <span>{{ $item->product->product_name }}</span>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        &#x20A6;{{ $item->amount }}
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Additional Information Below Total (Display Only Once) -->
                            <tr>
                                <td colspan="2" style="text-align: right; font-size: smaller;">Takeaway Fee:</td>
                                <td style="font-size: smaller;">&#x20A6;{{ $orderItems->first()->takeaway_pack }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: right; font-size: smaller;">Delivery Fee:</td>
                                <td style="font-size: smaller;">&#x20A6;{{ $orderItems->first()->delivery_fee }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: right; font-size: smaller;">Total Paid Amount:</td>
                                <td style="font-size: smaller;">&#x20A6;{{ $orderItems->first()->paid_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>No items in this order.</p>
                @endif
            </div>

            <!-- Social Media Links -->
            <div class="mail-social-media">
                <p>Find us on</p>
                <div>
                    <a href="#"> <i class="fa-brands fa-facebook mail-facebook"></i> </a>
                    <a href="#"> <i class="fa-brands fa-instagram mail-instagram"></i></a>
                    <a href="#"> <i class="fa-brands fa-x-twitter mail-twitter"></i></a>
                    <a href="#"> <i class="fa-brands fa-whatsapp mail-whatsapp"></i></a>
                </div>

                <div>
                    <p class="office-address">Office address: No 19, 16th Avenue, Gwarimpa Abuja Nigeria</p>

                    <p class="customer-service">Please contact<a href="#">customer service</a>if you have any questions</p>
                </div>

                <div class="copyright">
                    <h6>&copy; 2024 Amala247, All rights reserved.</h6>
                </div>
            </div>
        </div>

        {{-- @component('mail::subcopy')
        <div class="all-right">
            © {{ date('Y') }} Amala247 - Savor the Taste, Embrace the Tradition All rights reserved.
        </div>
        @endcomponent --}}
    </div>
</body>
</html>











