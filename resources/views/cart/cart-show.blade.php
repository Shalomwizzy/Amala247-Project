@extends('layouts.app')

@section('content')
<div class="container mt-5 mx-auto">
    @if (count($userCart) === 0)
        <h3 class="text-center">Your Cart is Empty</h3>
    @else
        <h2 class="text-center">Your Cart</h2>

        <div class="row">
            <div class="col-md-8 mt-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userCart as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->product->product_image) }}" alt="Product Image" width="100">
                                    </td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>₦{{ number_format($item->product->product_price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', ['productId' => $item->product->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="max-width: 70px;">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        ₦{{ number_format(($item->product->product_price + $item->delivery_fee + $item->takeaway_pack) * $item->quantity, 2) }}
                                    </td>
                                    <td>
                                        @if($item->product->product_name != 'Food Pack')
                                            <form action="{{ route('cart.remove', ['productId' => $item->product->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">CART TOTALS</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>₦{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Takeaway Pack Cost</td>
                                    <td id="takeaway-pack-cost">₦{{ number_format($takeawayPack, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Fee</td>
                                    <td>
                                        ₦{{ number_format($deliveryFee, 2) }}
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Coupon Discount</td>
                                    <td id="coupon-discount">
                                        @if (Session::has('coupon_discount'))
                                            -₦{{ number_format(Session::get('coupon_discount'), 2) }}

                                            <form action="{{ route('remove.coupon') }}" method="post" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Remove Coupon</button>
                                            </form>
                                        @else
                                            ₦0.00
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td id="total-amount">
                                        @if (session('delivery_fee', 0) > 0)
                                            ₦{{ number_format($total + session('delivery_fee', 0) - Session::get('coupon_discount', 0), 2) }}
                                        @else
                                            ₦{{ number_format($total - Session::get('coupon_discount', 0), 2) }}
                                        @endif
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>

                        <div class="checkbox-field">
                            <input class="input-code" value="1" type="checkbox" name="have-code" id="have-code">
                            <label for="have-code">I have coupon code</label>
                        </div>

                        <div class="sumarry-item" id="coupon-code-form" style="display: none;">
                            <form action="{{ route('apply.coupon') }}" method="post">
                                @csrf
                                <h4 class="title-box">Coupon Code</h4>
                                
                                    <label for="coupon-code">Enter your coupon code</label>
                                    <input type="text" name="coupon-code"> <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                               
                            </form>
                        </div>


                        <hr>
                        @if (auth()->check())
                            <form action="{{ route('pay.now') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total" value="{{ $total + session('delivery_fee', 0) - Session::get('coupon_discount', 0) }}">
                                <button type="submit" class="btn btn-success">PROCEED TO CHECKOUT</button>
                            </form>
                        @else
                            @guest
                                <h3 class="card-title mt-4">GUEST SHIPPING ADDRESS</h3>
                                <form method="POST" action="{{ route('guest.pay.now') }}">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total + session('delivery_fee', 0) - Session::get('coupon_discount', 0) }}">
                                    <button type="submit" class="btn btn-success">PROCEED TO CHECKOUT</button>
                                </form>
                            @endguest
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var haveCodeCheckbox = document.getElementById('have-code');
        var couponCodeForm = document.getElementById('coupon-code-form');

        haveCodeCheckbox.addEventListener('change', function () {
            couponCodeForm.style.display = haveCodeCheckbox.checked ? 'block' : 'none';
        });
    });
</script>

@endsection













