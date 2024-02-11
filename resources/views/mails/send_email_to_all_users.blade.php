<!-- resources/views/send-email.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container send-users">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Send Email to All Customer') }}</div>
                    <div class="card-body">
                        <form action="{{ route('mail.users') }}" method="post">
                            @csrf <!-- Add the CSRF token -->
                            <div class="form-group">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

        @component('mail::subcopy')
        <div class="all-right">
            © {{ date('Y') }} Amala247 - Savor the Taste, Embrace the Tradition All rights reserved.
        </div>
        @endcomponent
    </div>

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

     

        .mail-social-media{
            background-color: red;
            color: white;
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
@endsection



