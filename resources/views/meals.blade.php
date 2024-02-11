@extends('layouts.app')

@section('content')

    <!-- SEARCH AND DEFAULT -->
    <section>
    
        <div class="container d-flex justify-content-between search-default">
            <!-- Search button -->
            <form action="{{ route('search') }}" method="GET" class="mb-3">
                @csrf
                <div class="input-group search-btn">
                    <input type="search" name="search_term" class="form-control rounded search-input" placeholder="Search product" aria-label="Search" aria-describedby="search-addon" height="100" value="{{ $searchTerm ?? '' }}">
                    <button type="submit" class="btn btn-outline-danger submit">Submit</button>
                </div>
            </form>
            
            <!-- Default-price list -->
            <div class="dropdown default default-list">
                <button
                    class="btn btn-danger dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    Default sorting
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('search.sort', ['method' => 'low_to_high']) }}">Sort by price:low to high</a></li>
                    <li><a class="dropdown-item" href="{{ route('search.sort', ['method' => 'high_to_low']) }}">Sort by price high to low</a></li>
                    <li><a class="dropdown-item" href="{{ route('search.sort', ['method' => 'latest']) }}">Sort by latest</a></li>
                </ul>
            </div>
            
        </div>
    
      </section>
   
      <!-- CATEGORIES -->
      <section>
        <div class="container product-categories ">
            <span>CATEGORIES</span>
            <ul class="product-number">
                <li>
                    <a href="{{ route('breakfast') }}">BREAKFAST
                        <span class="number1">&star;4</span>
                    </a>
                    
                </li>
                ------------------------------
        
                <li>
                    <a href="{{ route('swallows') }}">SWALLOWS
                        <span class="number2">&star;4</span> 
                    </a>
                   
                </li>
                ------------------------------
                <li>
                    <a href="{{ route('meals') }}">MEALS
                        <span class="number3">&star;12</span>  
                    </a>
                     
                </li>
                ------------------------------
        
                <li>
                    <a href="{{ route('soups') }}">SOUPS
                        <span class="number4">&star;4</span>
                    </a>
                     
                </li>
                ------------------------------
        
                <li>
                    <a href="{{ route('protein') }}">PROTEIN
                        <span class="number5">&star;9</span> 
                    </a>
                    
                </li>
                ------------------------------
        
                <li>
                    <a href="{{ route('sauce') }}">SAUCE
                        <span class="number6">&star;3</span>
                    </a>
                    
                    
                </li>
                ------------------------------
        
                <li>
                    <a href="{{ route('drinks') }}">DRINKS
                        <span class="number7">&star;8</span>
                    </a>
                    
                   
                </li>
               </ul>
        
        
            </div>
           </section>
                <!-- Add other categories here -->
            </ul>
        </div>
     
      </section>
    
       

      

      <!-- PRODUCT LIST -->
      <section>
  
        <div class="container product-list">
            <div><span class="span">Showing all{{ $productCount }} results</span></div>
            <div class="row mt-5 gap-5">
                @forelse ($products as $product)
                <div class="card col-lg-3 col-md-6 mb-1">
                    <a href="#">
                        <img src="{{ asset($product->product_image) }}" class="card-img-top p-2" alt="{{ $product->product_name }}">
                    </a>
                    <div class="product-name">
                        <a href="#">
                            {{ $product->product_name }}
                        </a>
                        <span class="">&#x20A6;{{ number_format($product->product_price, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3">
                        {{-- <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST"> --}}
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                            <input type="hidden" name="product_price" value="{{ $product->product_price }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm order-button">
                                Order Now <i class="fa-solid fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <h2>No Meals Available.</h2>
                </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection