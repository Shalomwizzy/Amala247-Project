@extends('layouts.app')

@section('content') 
<div class="container">
    <h2>Shipping Address</h2>
    <form method="POST" action="{{ route('guest.pay.now') }}">
        @csrf

  
       
        <!-- Guest User Information -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country" value="Nigeria" readonly>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" value="Abuja" readonly>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <select class="form-control" id="city" name="city" required>
                <option value="" disabled selected>Select an Option</option>
                <option value="Gwagwalada">Gwagwalada</option>
                <!-- Add more city options as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" required>
        </div>

        <div class="form-group">
            <label for="house_number">House Number (Optional)</label>
            <input type="text" class="form-control" id="house_number" name="house_number">
        </div>
      
        
        <button type="submit" class="btn btn-success">PROCEED TO CHECKOUT</button>
    </form>
</div>
@endsection
 




