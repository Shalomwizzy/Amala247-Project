@extends('layouts.app')

@section('content')
<section>
    <!-- DASHBOARD -->
    <div class="container profile-pic">
        <div class="card border-0 shadow ">
            <div class="card-body dash-details">
                <p class="fs-5"> <span class="fw-bold welcome-text">Welcome
                    {{ $user->username }}!
                </span>
                 
                </p>
                <span class="mb-3 ml-5">
                    <img src="{{ $user->profile_picture }}" width="150" alt="{{ $user->username }}" class="img-fluid rounded-circle">
                </span>
                

                <div class="dash-details mt-4">
                    <div class="pt-2"> <a href="">Dashboard
                        <span class="dashboard-logo"> <i class="fa-solid fa-gauge"></i> </span>
                    </a>
                    <hr>
                </div>

                <div class="pt-2"> <a href="{{ route('order.history') }}">Orders 
                    <span class="order-logo"> <i class="fa-solid fa-cart-shopping"></i> </span>
                </a>
            </div>

            <hr>
            <div class="pt-2"> <a href="{{ route('address.view') }}">Address
                <span class="address-logo"> <i class="fa-solid fa-house-user"></i> </span>
            </a>
        </div>
        <hr>
        <div class="pt-2"> <a href="{{ route('account.details') }}"> Account details
            <span class="account-logo"> <i class="fa-solid fa-user"></i> </span>
        </a>
    </div>
    <hr>
</div>
</div>
</div>
</section>

<!-- WELCOME TEXTS -->
<section>
    <div class="container">
        <div>
            <p class="fs-5">
                Welcome back {{ $user->username}}! Not {{ $user->username }}?<span class="fw-bold"></span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn logout-btn">Logout</button>
                </form>
            </p>
        </div>

        <div class="account-dashboard mt-4">
            <p>From your account dashboard you can view your <a href="" class="recent-orders"> recent orders</a>, <br> update  your 
                <a href="">Shipping address <a> and view <a href="">Shipping address</a>
                
                <br> and edit your <a href="">Account details</a> </p>
        </div>
    </div>
</section>
@endsection