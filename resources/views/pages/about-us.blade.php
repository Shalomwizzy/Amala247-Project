@extends('layouts.app')

@section('content')
<section>
    <div class="container display-text" ></div>
      <img  src="{{ asset('images/eat4 aslow as 100 pic.jpg') }}" class=" cover-image" alt="...">
          
     
  
          <!-- about-us text -->
          <div class="aboutus1-text">
              <p>
                  Welcome to Amala 24/7, a restaurant located at no. 19, 6th Avenue, Gwarimpa. Our establishment is dedicated to providing our customers with an authentic and delicious dining experience that celebrates the rich and diverse flavors of Nigerian cuisine.
                  
                  At Amala 24/7, we take pride in our commitment to using only the freshest and highest quality ingredients in all of our dishes. We believe that the key to a memorable meal is not only the taste, but also the care and attention that goes into every aspect of the cooking process.
                  
                  Our menu features a wide variety of traditional Nigerian dishes, including our signature Amala and Ewedu soup, as well as a range of other stews, soups, and sides that are sure to satisfy any craving. And the best part? You can eat and be satisfied with as low as 1,000 Naira!
                  
                  But Amala 24/7 is more than just a restaurant. Our warm and inviting atmosphere makes it the perfect place to relax and enjoy great food with friends and family. Our spacious dining area is designed to create a comfortable and welcoming environment where you can savor your meal and unwind.
                  
                  In addition to our restaurant services, we also offer catering for events of all sizes. Our experienced team can create a custom menu to suit your needs and preferences, whether you're hosting a corporate lunch or a family gathering.
                  
                  And for those who prefer to enjoy our delicious food from the comfort of their own home, we offer home delivery services throughout Abuja. Simply place your order online or over the phone, and our friendly delivery team will bring your food right to your door.
                  
                  Our friendly and attentive staff are dedicated to ensuring that your dining experience is nothing short of exceptional. So come join us at Amala 24/7 and experience the true taste of Nigeria in a welcoming and enjoyable setting, or let us bring the taste to you. We look forward to serving you!</p>
          </div>
                <!-- side-image -->
          <div>
              <img src="{{ asset('images/unsplash pondo-efo.jpg') }}" class="img-fluid second-image" alt="" width="500">
          </div>
      </div>
   </section>
  
   <!-- FOOD SATISFACTION -->

   <section class="bg-light">
    <div class="container d-flex justify-content-between align-items-center py-3 satisfaction">
        <div class="text-center">
            <p class="mb-0">90%</p>
            <span class="text-muted">TASTE</span>
        </div>
        <div class="text-center">
            <p class="mb-0">90%</p>
            <span class="text-muted">SATISFACTION</span>
        </div>
        <div class="text-center">
            <p class="mb-0">90%</p>
            <span class="text-muted">REVIEW</span>
        </div>
    </div>
</section>
@endsection