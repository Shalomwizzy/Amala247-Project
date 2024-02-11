

@extends('layouts.admin') 

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        
          
        
        <div class="w-50">
            <h2 class=" mb-4">Create Coupon</h2>
         <a href="{{ route('coupon.index') }}" class="btn  btn-sm btn-success mb-4">All Coupons </a>

            <form method="POST" action="{{ route('coupon.store') }}">
                @csrf

                <div class="mb-3 col-6">
                    <label for="code" class="form-label">Coupon Code:</label>
                    <input type="text" name="code" class="form-control"  required>
                </div>

                <div class="mb-3 col-6">
                    <label for="type" class="form-label">Coupon Type:</label>
                    <select name="type" class="form-control" required>
                        <option value="percent">Percent</option>
                        <option value="fixed">Fixed Amount</option>
                    </select>
                </div>

                <div class="mb-3 col-6">
                    <label for="value" class="form-label">Coupon Value:</label>
                    <input type="number" name="value" class="form-control"required>
                </div>

                <div class="mb-3 col-6">
                    <label for="cart_value" class="form-label"> Cart Value:</label>
                    <input type="number" name="cart_value" class="form-control" required>
                </div>

                <div class="mb-3 col-6">
                    <label for="expiry_date" class="form-label">Expiry Date:</label>
                    <input type="date" id="expiry_date" name="expiry_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Coupon</button>
            </form>
        </div>
    </div>
@endsection




