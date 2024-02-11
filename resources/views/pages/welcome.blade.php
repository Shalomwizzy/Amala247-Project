@extends('layouts.app')

@section('content')


  <!-- First Heading -->
  <section>
    <div>
      <!-- first heading text -->
      <h5 class="text-center my-3 first-heading ahref-text">
        Indulge in the Rich Tastes of Nigeria at
        <strong class="first-amala">Amala 24/7</strong> <br />
        Gwarinpa's Best Kept Secret for Authentic Cuisine in Abuja!
      </h5>
    </div>
  </section>

  <!-- CAROUSEL -->
  <section>
    <div
      id="carouselExampleDark"
      class="carousel carousel-dark slide carousel-images"
    >
      <div class="carousel-indicators">
        <!-- carousel-button-->
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="3"
          aria-label="Slide 4"
        ></button>
      </div>

      <!-- first-image details -->
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2500">
          <img src="{{ asset('images/fish.JPG') }}" class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="ahref-text">
              Fuel Your Body with Delicious Proteins at Amala 24/7
            </h5>
            <p>
              Our menu is packed with high-quality proteins, <br />
              cooked to perfection and served with flavorful sides. <br />
              Whether you're a meat-lover or a seafood enthusiast, <br />
              we have something for everyone.
            </p>
          </div>

          <!-- second-image details -->
        </div>
        <div class="carousel-item" data-bs-interval="2500">
          <img
            src="{{ asset('images/pot stew2.JPG') }}"
            class="d-block w-100"
            alt="..."
          />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="ahref-text">
              Indulge in Comforting Soups and Stews at Amala 24/7
            </h5>
            <p>
              Our soups and stews are made from fresh, locally-sourced <br />
              ingredients and cooked with love and care. From hearty beef
              <br />
              stews to spicy chicken soups, our menu offers a wide variety of
              <br />
              flavors and textures to warm your soul on any day.
            </p>
          </div>
        </div>

        <!-- third-image details -->
        <div class="carousel-item" data-bs-interval="2500">
          <img
            src="{{ asset('images/pot jollof.JPG') }}"
            class="d-block w-100"
            alt="..."
          />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="ahref-text">
              Satisfy Your Cravings with Our Delicious Rice Dishes at Amala
              24/7
            </h5>
            <p>
              Our rice dishes are crafted to perfection, with each grain
              cooked <br />
              to a fluffy and tender texture. From the classic fried rice to
              the <br />
              spicy jollof rice, our menu offers a wide range of rice dishes
              to <br />
              suit every taste bud. And for those seeking a taste of home, our
              <br />
              native rice dishes will take you on a culinary journey through
              the <br />
              flavors of Nigeria.
            </p>
          </div>
        </div>

        <!-- FOURTH IMAGE DETAILS -->
        <div class="carousel-item" data-bs-interval="2500">
          <img
            src="{{ asset('images/pot-amala.JPG') }}"
            class="d-block w-100"
            alt="..."
          />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="ahref-text">
              Experience the Richness of Our Traditional Solid Foods at Amala
              24/7
            </h5>
            <p>
              Our solid-based dishes are made from the finest ingredients,
              <br />
              prepared with the utmost care to bring you the authentic taste
              of <br />
              Nigerian cuisine. Whether you're a fan of the smoothness of
              <br />
              pounded yam, the soft texture of amala, or the hearty feel of
              eba <br />
              and wheat, we've got you covered with a variety of solid food
              <br />
              options that are sure to satisfy your cravings."
            </p>
          </div>
        </div>
      </div>
      <!-- carousel-button 2 -->
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleDark"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleDark"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- sub-header-->
    <div>
      <h2 class="text-center aslow-one">
        Eat for as low as <strong class="ahref-text">&#8358;1,000</strong> at
        Amala 24/7
      </h2>
    </div>
  </section>

  <!-- VARIETIES -->
  <section>
    <div class="container">
      <!-- first-image details -->
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4 foodname-price">
          <a href="#">
            <img
              src="{{ asset('images/design-pomo.jpeg') }}"
              alt=""
              width="400"
              height="500"
            />
            <p>
              POMO <br />
              &#8358;300.00
            </p>
          </a>
        </div>
        <!-- second-image details-->

        <div class="col-lg-4 col-md-6 mb-4 foodname-price">
          <a href="#">
            <img
              src="{{ asset('images/design rice and beans.jpeg') }}"
              alt=""
              width="400"
              height="500"
            />
            <p>
              RICE AND BEANS <br />
              &#8358;700.00
            </p>
          </a>
        </div>

        <!--third-image details-->

        <div class="col-lg-4 col-md-6 mb-4 foodname-price">
          <a href="#">
            <img
              src="{{ asset('images/design egusi.png') }}"
              alt=""
              width="400"
              height="500"
            />
            <p>
              EGUSI <br />
              &#8358;500.00
            </p>
          </a>
        </div>

        <!-- fourth-image details -->

        <div class="col-lg-4 col-md-6 mb-4 foodname-price">
          <a href="#">
            <img
              src="{{ asset('images/design-jollofrice.jpeg') }}"
              alt=""
              width="400"
              height="500"
            />
            <p>
               JOLLOF RICE<br />
              &#8358;700.00
            </p>
          </a>
        </div>

        <!-- fifth-image details-->
        <div class="col-lg-4 col-md-6 mb-4 foodname-price">
          <a href="#">
            <img
              src="{{ asset('images/design goat-meat.jpeg') }}"
              alt=""
              width="400"
              height="500"
            />
            <p>
              GOAT MEAT <br />
              &#8358;700.00
            </p>
          </a>
        </div>

        <!-- sixth-image details -->

        <div class="col-lg-4 col-md-6 mb-4 foodname-price">
          <a href="#">
            <img
              src="{{ asset('images/design amala.jpeg') }}"
              alt=""
              width="400"
              height="500"
            />
            <p>
              AMALA <br />
              &#8358;150.00
            </p>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ORDER ONLINE  -->
  <section class="section-order">
    <!-- order-online -->
    <div class="container">
      <div class="row">
        <div class=" col-lg-6 col-md-6  order-online-watsapp">
          <a href="https://wa.link/1zrgww" target="_blank">
            <i class="fa-brands fa-whatsapp order-online-fa">
              <span class="order-text text-center"> ORDER VIA WHATSAPP</span>
            </i>
          </a>
        </div>
        <!-- order-on whatsapp-->
        <div class="col-lg-6 col-md-6  order-online-watsapp">
          <a href="tel:+2349088888411" target="_blank">
            <i class="fa-sharp fa-solid fa-phone order-online-fa">
              <span class="order-text text-center">09088888411 CALL US</span>
            </i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- QUALITY ASSURANCE -->
  <section>
    <!-- exceptional-text -->
    <div class="container quality-assure">
      <h2 class="text-center">
        Exceptional Taste Exceptional Quality at Amala 24/7
      </h2>

      <div>
        <!-- write-up text-->
        <p class="text-center">
          At Amala 24/7 we understand that food is not just a necessity, but a
          way of life. That's why we go above and beyond to ensure <br />
          that our customers get nothing but the best of the best. We are
          committed to using only the freshest and highest quality ingredients
          <br />
          in all our dishes. Our menu features a variety of authentic Nigerian
          cuisine that is prepared by our skilled chefs with <br />
          years of experience in the culinary. <br />
          <br />
          In addition to our commitment to quality ingredients and expert
          preparation, we also take pride in our commitment to food safety and
          hygiene. <br />
          Our kitchen is equipped with the latest technology and our staff is
          trained to adhere to strict hygiene and sanitation guidelines to
          ensure <br />
          that our food is safe and healthy to consume. We understand that our
          customers have high expectations when it comes to the quality of
          <br />
          food they consume, and we are committed to exceeding those
          expectations. We take our responsibility to provide the best <br />
          possible dining experience seriously, and we strive to ensure that
          every customer leaves our restaurant satisfied and happy. <br />
          Thank you for choosing Amala 24/7. We look forward to serving you
          soon.!
        </p>
      </div>
    </div>
  </section>

  <!-- SUB-FOOTER  -->
  <section class="bg-black center-align">
    <!-- image -->
    <img
      class="background-img"
      src="{{ asset('images/unsplash pondo-efo.jpg') }}"
      alt=""
    />
    <div class="text-input container">
      <!-- text-->
      <h3 class="text-center">
        EAT FOR AS LOW AS &#x20A6;1000 AT AMALA 24/7
      </h3>
      <div class="row">
        <!-- working-hours -->
        <div class="col-lg-4 col-md-6 mb-3">
          <p>MONDAY TO SUNDAY: 7AM-10PM</p>
        </div>
        <!-- email and number-->
        <div class="col-lg-4 col-md-6 mb-3">
          <p>
            EMAIL: bestamala247@gmail.com <br />
            PHONE NUMBER:09088888411
          </p>
        </div>
        <!-- location -->
        <div class="col-lg-4 col-md-6 mb-3">
          <p>LOCATION: No.19, 6th Avenue, Gwarimpa Abuja, Nigeria</p>
        </div>
      </div>

    </div>
  </section>
@endsection
