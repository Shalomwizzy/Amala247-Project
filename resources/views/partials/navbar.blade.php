<section class="m-5">
  @guest
  <nav class="navbar navbar-expand-lg bg-body-tertiary  nav-tog fixed-top">

    {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top"> --}}
    <div class="container-fluid bg-dark navbar-dark guest-nav">
      <a class="navbar-brand amala247 ahref-text" href="{{ route('welcome') }}">
        <!-- logo-image -->
        <img class="logo" src="{{ asset('images/main logo.jpg') }}" width="80" alt="LOGO">
        AMALA 24/7 &#9734;
      </a>
      
      <!-- nav bars -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="fa-solid fa-bars fa-lg text-danger"></span>
      </button>
     
        
    
      <div class="collapse navbar-collapse justify-content-between navbarcontainer" id="navbarNavDropdown">
        <ul class="navbar-nav navbarheader ">
          <li class="nav-item">
            <a class="nav-link active ahref-text" aria-current="page" href="{{ route('welcome') }}">HOME &#9734;</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('menu') }}">MENU &#9734;</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('contact.us') }}">CONTACT US &#9734;</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('promo') }}">PROMO &#9734;</a>
          </li>
          

          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('order.track') }}">TRACK ORDER &#9734;</a>
          </li>
       

          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle active ahref-text"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              OUR SERVICES &#9734;
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item ahref-text" href="{{ route('bachelor') }}">Bachelor Kitchen</a>
              </li>
              <li>
                <a class="dropdown-item ahref-text" href="{{ route('event') }}">Event Planning</a>
              </li>
            </ul>
          </li>

        </ul>

        <div class="d-none d-md-flex align-items-center cart-wishlist">

          {{-- Show the icons for non-authenticated users --}}
          @php
          $cartCount = session('cart') ? count(session('cart')) : 0;
          $wishlistCount = session('wishlist') ? count(session('wishlist')) : 0;
          @endphp
      
          @if($cartCount > 0)
          <a href="{{ route('cart.show') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-cart-shopping cart-logo animate__animated animate__swing">
                  <span class="badge bg-secondary cart-badge">{{ $cartCount }}</span>
              </i>
          </a>
          @endif
          @if($wishlistCount > 0)
          <a href="{{ route('wishlist.show') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-heart heart-logo  animate__animated animate__swing">
                  <span class="badge bg-secondary wishlist-badge">{{ $wishlistCount }}</span>
              </i>
          </a>
          @endif
         
          @endguest
      </div>
       
        <div class="d-flex align-items-center sub-nav-guest">

          <a href="{{ route('order.now') }}" class="btn btn-sm btn-outline-dark mx-2"> <i class="fa-solid fa-shopping-cart"></i> ORDER NOW 
          </a>

          {{-- <a href="{{ route('order.track') }}" class="btn btn-sm btn-outline-dark mx-2"> <i class="fa-solid fa-motorcycle"></i> TRACK ORDER
          </a> --}}

          <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark"> <i class="fa-solid fa-user"></i> LOGIN / REGSITER  </a>
        
   
          </div>
      
        </div>
      </div>
    </div>
  </nav>
</section>






{{-- Autheticated User --}}

<section>
  @auth
    

  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top nav-tog">
    <div class="container bg-dark navbar-dark auth-user-navbar">
      <a class="navbar-brand amala247 ahref-text" href="{{ route('home') }}">
        <!-- logo-image -->
        <img src="assets/images/main logo-edit.png" alt="" width="90" />
        AMALA 24/7 &#9734;
      </a>
      <!-- nav bars -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="fa-solid fa-bars fa-lg text-danger"></span>
      </button>
      <div
        class="collapse navbar-collapse justify-content-center navbarcontainer"
        id="navbarNavDropdown"
      >
        <ul class="navbar-nav navbarheader">
          <li class="nav-item">
            <a
              class="nav-link active ahref-text"
              aria-current="page"
              href="{{ route('dashboard') }}"
              >DASBOARD &#9734;
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('menu') }}"
              >MENU &#9734;
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('order.now') }}"
              >ORDER NOW &#9734;
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('order.track') }}"
              >TRACK ORDER &#9734;
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('reviews.create') }}">REVIEWS &#9734;</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active ahref-text" href="{{ route('order.history') }}"
              >ORDER HISTORY &#9734;
            </a>
          </li>

          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn  mx-2 logout-btn">LOGOUT <i class="fa-solid fa-user"></i></button>
              
            </form>
          </li>
          
        </ul>

        <div class="d-none d-md-flex align-items-center cart-wishlist">
          
          {{-- Retrieve cart and wishlist counts for authenticated users --}}
          @php
          $cartCount = auth()->user()->cart->where('cart_status', 'added')->count();
          $wishlistCount = auth()->user()->wishlist->count();
          @endphp
      
          @if($cartCount > 0)
          <a href="{{ route('cart.show') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-cart-shopping cart-logo animate__animated animate__swing">
                  <span class="badge bg-secondary auth-cart-badge" style="font-size: 10px;">{{ $cartCount }}</span>
              </i>
          </a>
          @endif
          @if($wishlistCount > 0)
          <a href="{{ route('wishlist.show') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-heart cart-logo animate__animated animate__swing">
                  <span class="badge bg-secondary auth-wishlist-badge">{{ $wishlistCount }}</span>
              </i>
          </a>
          @endif
          @else
        @endauth
        </section>

     
    







        <div class="fixed-bottom-btns">
          <a href="{{ route('order.now') }}" class="nav-link text-nowrap">
              <i class="fa-brands fa-first-order"></i>
              Order Now
          </a>
      
          <a href="{{ route('order.track') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-motorcycle"></i>
              Track Order
          </a>
      
          @php
          $cartCount = 0;
          $wishlistCount = 0;
      
          if(auth()->check()) {
              $cartCount = Auth::user()->cart()->where('cart_status','added')->count();
              $wishlistCount = Auth::user()->wishlist()->count();
          } else {
              $cartCount = session()->has('cart') ? count(session('cart')) : 0;
              $wishlistCount = session()->has('wishlist') ? count(session('wishlist')) : 0;
          }
          @endphp
      
          @if($cartCount > 0)
          <a href="{{ route('cart.show') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-cart-shopping animate__animated animate__swing">
                  <span class="badge bg-secondary">{{ $cartCount }}</span>
              </i>
              Cart
          </a>
          @endif
      
          @if($wishlistCount > 0)
          <a href="{{ route('wishlist.show') }}" class="nav-link text-nowrap">
              <i class="fa-solid fa-heart animate__animated animate__swing">
                  <span class="badge bg-secondary">{{ $wishlistCount }}</span>
              </i>
              Wishlist
          </a>
          @endif
      
          <img class="logo" src="{{ asset('images/amala247logo.jpg') }}" alt="Logo">
      </div>
      


