@extends('layouts.app')

@section('content')
  
  <!-- CONTACT-US -->
  <section>
    <!-- header-image -->
    {{-- <div class="container-fluid contact-us">
        <img src="assets/images/design goat-meat.jpeg" class="first-image" alt="" width="100%" height="400">
    </div> --}}
    <div class=" container row contact-info">

       <!--our location-->
        <div class="col-lg-3 col-md-6 mb-3 our-location">
        <p class="text-header">OUR LOCATION</p>
    
        <p><i class="fa-solid fa-phone"></i> 0908-888-8411</p>
        <p><i class="fa-brands fa-facebook"></i> @aamala247</p>
        <p><i class="fa-solid fa-envelope"></i>bestamala247@gmail.com</p>
        <p><i class="fa-solid fa-location-dot"></i>No.19,16th Avenue, Gwarimpa, Abuja Nigeria</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.3786182677154!2d7.387978974872547!3d9.120232790944797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104ddf7eb47ccead%3A0x1bebb4b436918c6e!2s19%206th%20Ave%2C%20Gwarinpa%20900108%2C%20Abuja%2C%20Federal%20Capital%20Territory!5e0!3m2!1sen!2sng!4v1684185717551!5m2!1sen!2sng" class="google-mab" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- send-message form -->
        <div  class="col-lg-3 col-md-6 mb-3 get-touch">
            <p class="text-center text-header">GET IN TOUCH </p>
            <form action="{{ route('send.mail') }}" method="POST"  >
                @csrf
                <label for="name"> 
                    <input  type="text" name="name" class="form-control form-input" placeholder="Name">
                </label> <br><br>

                <label for="email"> 
                    <input type="email" name="email"  class="form-control form-input" placeholder="Email">
                </label> <br><br>

                <label for="Phone-number"> 
                    <input type="tel" name="phone-number"  class="form-control form-input" placeholder="Telephone">
                </label><br><br>

                
                    <label for="message" class="form-label"></label>
                   <textarea name="message" class="form-control" id="message" rows="4" placeholder="message"></textarea> <br> <br>

                   <button class="btn btn-outline-danger">Submit</button>
                
                
            </form>
       
              </div>
        </div>
    </div>
</section>  
@endsection