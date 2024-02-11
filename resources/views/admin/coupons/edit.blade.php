@extends('layouts.admin')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="w-50">
            <h2>Edit Coupon</h2>
            <form method="POST" action="{{ route('coupon.update', ['id' => $coupon->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="code" class="form-label">Coupon Code:</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Coupon Type:</label>
                    <select name="type" class="form-control" required>
                        <option value="percent" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percent</option>
                        <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="value" class="form-label">Coupon Value:</label>
                    <input type="number" name="value" class="form-control" value="{{ old('value', $coupon->value) }}" required>
                </div>

                <div class="mb-3">
                    <label for="cart_value" class="form-label">Minimum Cart Value:</label>
                    <input type="number" name="cart_value" class="form-control" value="{{ old('cart_value', $coupon->cart_value) }}" required>
                </div>

                <div class="mb-3 col-6">
                    <label for="expiry_date" class="form-label">Expiry Date:</label>
                    <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $coupon->expiry_date) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Coupon</button>
            </form>
        </div>
    </div>


@endsection
