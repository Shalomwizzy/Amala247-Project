@if(auth()->user()->role === 'admin')
<nav class="navbar navbar-expand-md admin-nav">
    <div class="container">
        <a href="" class="navbar-brand">
            <img class="logo" src="{{ asset('images/main logo.jpg') }}" width="80" alt="LOGO">
            <span> Amala247</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a></li>
                
                <li class="nav-item"><a href="{{ route('sales.chart') }}" class="nav-link">Sales Chart</a></li>
               

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-tag"></i>
                      Category
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('category.index') }}">All Categories</a></li>
                      <li><a class="dropdown-item" href="{{ route('category.create') }}">Create Category </a></li>
                     
                    </ul>
                  </li>


                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                      <i class="fa-brands fa-product-hunt"></i>
                      Products
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('products.index') }}">All Products</a></li>
                      <li><a class="dropdown-item" href="{{ route('product.create') }}">Create Product </a></li>
                     
                    </ul>
                  </li>

                    {{-- COUPONS --}}
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-sharp fa-solid fa-c"></i>
                      Coupons
                    </a>
                    <ul class="dropdown-menu">

                      <li><a class="dropdown-item" href="{{ route('coupon.index') }}">All Coupons</a></li>
                      <li><a class="dropdown-item" href="{{ route('coupon.create') }}">Create Coupon  </a></li>
                      
                    </ul>
                  </li>
                  
                
              <li class="nav-item">
                  <a href="{{ route('orders.index') }}" class="nav-link">
                      <i class="fas fa-envelope"></i>
                     
                          <span class="badge badge bg-secondary auth-cart-badge"></span>
                    
                      Orders
                  </a>
              </li>
            

                {{-- REVIEWS --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-star"></i>
                    Reviews
                  </a>
                  <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="{{ route('reviews.index') }}">Reply/Delete</a></li>
                    <li><a class="dropdown-item" href="{{ route('reviews.view') }}">All Reviews </a></li>
                    
                  </ul>


                {{-- USERS --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                   USERS
                  </a>
                  
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('admin.workers.create') }}">Create User </a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Users</a></li>
                    
                    
                  </ul>
                 
                </li>
        
                
                <li class="nav-item"><a href="{{ route('send.email.to.all.users') }}" class="nav-link">Send&nbsp;Mails</a></li>

                  
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif



{{-- MANAGER --}}


@if(auth()->user()->role === 'manager')
<nav class="navbar navbar-expand-md admin-nav">
    <div class="container">
        <a href="" class="navbar-brand">
            <img class="logo" src="{{ asset('images/main logo.jpg') }}" width="80" alt="LOGO">
            <span> Amala247</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a></li>
                
                <li class="nav-item"><a href="{{ route('sales.chart') }}" class="nav-link">Sales Chart</a></li>
               

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-tag"></i>
                      Category
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('category.index') }}">All Categories</a></li>
                      <li><a class="dropdown-item" href="{{ route('category.create') }}">Create Category </a></li>
                     
                    </ul>
                  </li>


                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                      <i class="fa-brands fa-product-hunt"></i>
                      Products
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('products.index') }}">All Products</a></li>
                      <li><a class="dropdown-item" href="{{ route('product.create') }}">Create Product </a></li>
                     
                    </ul>
                  </li>
                  
                
              <li class="nav-item">
                  <a href="{{ route('orders.index') }}" class="nav-link">
                      <i class="fas fa-envelope"></i>
                     
                          <span class="badge badge bg-secondary auth-cart-badge"></span>
                    
                      Orders
                  </a>
              </li>
            

                {{-- REVIEWS --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-star"></i>
                    Reviews
                  </a>
                  <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="{{ route('reviews.index') }}">Reply/Delete</a></li>
                    <li><a class="dropdown-item" href="{{ route('reviews.view') }}">All Reviews </a></li>
                    
                  </ul>

        
                
                <li class="nav-item"><a href="{{ route('send.email.to.all.users') }}" class="nav-link">Send&nbsp;Mails</a></li>

                  
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif








{{-- SALES PERSON  --}}

@if(auth()->user()->role === 'salesperson')
<nav class="navbar navbar-expand-md admin-nav">
    <div class="container">
        <a href="" class="navbar-brand">
            <img class="logo" src="{{ asset('images/main logo.jpg') }}" width="80" alt="LOGO">
            <span> Amala247</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a></li>
                
                <li class="nav-item"><a href="{{ route('sales.chart') }}" class="nav-link">Sales Chart</a></li>
               

                


                  

                 
                  
                
              <li class="nav-item">
                  <a href="{{ route('orders.index') }}" class="nav-link">
                      <i class="fas fa-envelope"></i>
                     
                          <span class="badge badge bg-secondary auth-cart-badge"></span>
                    
                      Orders
                  </a>
              </li>
            

                {{-- REVIEWS --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-star"></i>
                    Reviews
                  </a>
                  <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="{{ route('reviews.index') }}">Reply/Delete</a></li>
                    <li><a class="dropdown-item" href="{{ route('reviews.view') }}">All Reviews </a></li>
                    
                  </ul>



        


                  
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif










































  <!-- Fixed bottom buttons for phones -->
  <div class="fixed-bottom-btns">

    <a href="{{ route('orders.index') }}" class="nav-link text-nowrap">
      <i class="fa-brands fa-first-order"></i>
      Orders
  </a>



  <a href="{{ route('sales.chart') }}" class="nav-link text-nowrap">
    <i class="fa-solid fa-naira-sign"></i>
      Sales Chat
  </a>

  <a href="{{ route('reviews.index') }}" class="nav-link text-nowrap">
    <i class="fa-solid fa-solid fa-star"></i>
    Reviews
</a>

    <img class="logo" src="{{ asset('images/amala247logo.jpg') }}" alt="Logo">
  </div>
  </div>

