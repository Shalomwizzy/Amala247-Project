<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <title>
        Thank you for contacting us
    </title>

</head>
<body>
    <div class="container">
        <div class="thank-you">
            Thank You for Contacting Us
        </div>

        <p>Hello {{ $data['name'] }},</p>
        <p>Thank you for contacting us. We have received your message and will get back to you shortly.</p>

        <div class="details">
            <p><strong>Name:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Message:</strong> {{ $data['message'] }}</p>
        </div>

        <p>Best regards,<br>Lahaadee Kiddies</p>

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

        @component('mail::subcopy')
        <div class="all-right">
            © {{ date('Y') }} Amala247 - Savor the Taste, Embrace the Tradition All rights reserved.
        </div>
        @endcomponent
    </div>


    <style>
        /* Add your custom CSS styles here */
        .contact-response {
            text-align: center;
            margin-top: 20px;
        }

        .contact-response .social-icons {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contact-response .social-icon {
            margin: 0 10px;
            font-size: 20px;
            color: #555555;
        }

        .contact-response .subcopy {
            margin-top: 20px;
            border-top: 1px solid #cccccc;
            text-align: center;
            padding-top: 20px;
        }

        .contact-response .subcopy-text {
            font-size: 12px;
            color: #555555;
        }

        .all-right{
            font-size: 8px;
            font-family: Arial, Helvetica, sans-serif;
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
</body>
</html>
















