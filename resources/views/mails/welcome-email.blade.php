<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Amala 247</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <style>
        /* Add your custom CSS styles here */
        .welcome-email {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-heading {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .welcome-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .welcome-logo img {
            max-width: 50px; /* Adjust the size as needed */
            max-height: 50px; /* Adjust the size as needed */
            height: auto;
        }

        .logo-text {
            font-size: 20px;
            font-weight: bold;
            margin-left: 10px; /* Add margin for spacing */
        }

        .welcome-text {
            font-size: 16px;
            line-height: 1.5;
        }

        .signature {
            font-style: italic;
        }

        .mail-social-media{
            background-color: red;
            color: white !important;
            padding: 8px;
            text-align: center;
           
        }

        .mail-social-media a{
            text-decoration: none;
            color: white !important;
            padding: 10px;
            font-size: 16px;
        }

        .mail-social-media i{
        font-size: 18px;
      
        }



        .mail-social-media .mail-facebook{
        color: blue;
      
        }

        .mail-social-media .mail-instagram{
            color: #f09433;
        }

        .mail-social-media .mail-twitter{
           color: black !important;
        }

        .mail-social-media .mail-whatsapp{
        color: green !important;
        }

        .customer-service{
          font-size: 14px;
          font-family: Arial, Helvetica, sans-serif;
        }

        .customer-service a{
            text-decoration: underline !important;
            color: blue !important;
        }

        .office-address{
            font-size: 14px;
          font-family: Arial, Helvetica, sans-serif; 
        }


    </style>
</head>
<body>
    <div class="welcome-email">
        <div class="welcome-logo">
            <img src="{{ asset('images/main logo-edit.png') }}" width="90" alt="Amala 247 Logo" class="img-fluid">

            <div class="logo-text">Amala247</div>
        </div>
        <p class="welcome-text">Hello {{ $user['username'] }}!</p>
        <strong class="welcome-heading">Welcome to Amala247!</strong>
        <p>My name is Folorunso, Co-founder and CEO of Amala247.</p>
        <p class="welcome-text">Thank you for choosing Amala247, your local restaurant for quick and delicious dining experiences.</p>
        <p class="welcome-text">At Amala247, we take pride in our lightning-fast delivery service, ensuring that your favorite dishes reach your doorstep in record time. We understand the importance of enjoying your meals promptly, and our dedicated delivery team works tirelessly to make it happen.</p>
        <p class="welcome-text">Explore our menu, place your order, and rest assured that we'll deliver your scrumptious meal with speed and precision. Whether it's a cozy night in or a busy day at the office, Amala247 is here to bring tasty delights straight to you.</p>
        <p class="welcome-text">If you ever have any specific delivery preferences or need assistance with your order, our customer support team is ready to assist you promptly. Your satisfaction is our priority!</p>
        <p class="welcome-text">We're delighted to have you as part of the Amala247 community, where delicious meals come to you fast!</p>
        <p class="welcome-text">Best regards,</p>
        <p class="welcome-text signature">Folorunso, CEO</p>
        <p class="welcome-text signature">Amala247</p>

        <div class="mail-social-media">  
            <p>Find us on</p>
            <div>
             <a href="">  <i class="fa-brands fa-facebook mail-facebook"></i> </a>
             <a href="">  <i class="fa-brands fa-instagram mail-instagram"></i></a>
             <a href="">  <i class="fa-brands fa-x-twitter mail-twitter"></i></a>
             <a href="">  <i class="fa-brands fa-whatsapp mail-whatsapp"></i></a>
            </div>
    
            <div>
                <p class="office-address">Office address: No 19, 16th Avenue, Gwarimpa 
                    Abuja Nigeria</p>
    
                    <p class="customer-service">Please contact<a href="">customer service</a>if you have any questions</p>
            </div>
    
            <div class="copyright">
                <h6>&copy; 2024 Amala247, All rights reserved.</h6>
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







