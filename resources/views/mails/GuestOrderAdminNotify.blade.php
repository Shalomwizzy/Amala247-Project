
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
    <!-- Add Bootstrap CSS link here or include your own styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .order-details {
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

        .order-details img {
            max-width: 50px; /* Adjust the size as needed */
            margin-right: 10px;
        }

        .order-details .product-info img {
            max-width: 50px;
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

        .social-media {
            background-color: #ff6f6f;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 30px;
        }

        .copyright {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Order Notification</h2>
            <p>A new order has been placed. Here are the details:</p>
        </div>

        <div class="order-details">
            <h3>Order Details:</h3>
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

                    <!-- Guest Details -->
                    <tr>
                        <td colspan="3"><strong>Customer Name:</strong> {{ $orderItems->first()->guest->first_name }} {{ $orderItems->first()->guest->last_name }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Phone Number:</strong> {{ $orderItems->first()->guest->phone_number }}</td>
                    </tr>

                    <tr>
                        <td colspan="3"><strong>Email:</strong> {{ $orderItems->first()->guest->email }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Shipping Address:</strong>
                            {{ optional($orderItems->first()->guest)->street_address ?? '' }},
                            {{ optional($orderItems->first()->guest)->house_number ?? '' }},
                            {{ optional($orderItems->first()->guest)->city ?? '' }},
                            {{ optional($orderItems->first()->guest)->state ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
           

        <div class="copyright">
            <h6>&copy; 2024 Amala247, All rights reserved.</h6>
        </div>
        
    </div>
</body>
</html>



