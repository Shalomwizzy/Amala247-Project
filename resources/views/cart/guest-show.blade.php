@extends('layouts.app')

@section('content')
<div class="container mt-5 mx-auto">
    @if (count($userCart) === 0)
        <h3 class="text-center">Your Cart is Empty</h3>
    @else
        <h2 class="text-center">Your Cart</h2>

        <div class="row">
            <!-- Cart Display for Authenticated User -->
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
                                        ₦{{ number_format(($item->product->product_price ) * $item->quantity, 2) }}
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

            <!-- Cart Totals for Guest -->
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
                                    <td id="takeaway-pack-cost">₦{{ number_format($takeawayPackFee, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Fee</td>
                                    <td id="delivery-fee-display">
                                        ₦{{ number_format($deliveryFee, 2) }}
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Total</td>
                                    <td id="total-amount">
                                        ₦{{ number_format($subtotal + $takeawayPackFee + $deliveryFee, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" onclick="showGuestShippingAddress()" id="proceed-to-checkout">PROCEED TO CHECKOUT</button>
                    </div>
                </div>

                <!-- Guest Shipping Address Form -->
                <div class="card mt-3" id="guest-shipping-address" style="display: none;">
                    <div class="card-body">
                        <h3 class="card-title">GUEST SHIPPING ADDRESS</h3>
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
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" required>
                            </div>
                
                            <div class="form-group">
                                <label for="city">City</label>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="" disabled selected>Select an Option</option>
                                    <option value="Gwagwalada">Gwagwalada</option>
                                    <option value="Kuje">Kuje</option>
                                    <option value="Abaji">Abaji</option>
                                    <option value="Bwari">Bwari</option>
                                    <option value="Kwali">Kwali</option>
                                    <option value="Lugbe">Lugbe</option>
                                    <option value="Karu">Karu</option>
                                    <option value="Nyanya">Nyanya</option>
                                    <option value="Jabi">Jabi</option>
                                    <option value="Maitama">Maitama</option>
                                    <option value="Wuse">Wuse</option>
                                    <option value="Garki">Garki</option>
                                    <option value="Asokoro">Asokoro</option>
                                    <option value="Wuse II">Wuse II</option>
                                    <option value="Utako">Utako</option>
                                    <option value="Central Business District (CBD)">Central Business District (CBD)</option>
                                    <option value="Kubwa">Kubwa</option>
                                    <option value="Gwarimpa">Gwarimpa</option>
                                </select>
                            </div>


                            <script>
                                document.getElementById('city').addEventListener('change', function() {
                                    var city = this.value;
                                    var deliveryFee = calculateDeliveryFee(city);
                                    document.getElementById('delivery-fee-display').innerText = '₦' + deliveryFee.toFixed(2);
                                    document.getElementById('total-amount').innerText = '₦' + ({{ $subtotal }} + {{ $takeawayPackFee }} + deliveryFee).toFixed(2);
                                });
                
                                function calculateDeliveryFee(city) {
                                    // Retrieve delivery fee based on city from backend or configuration
                                    // You can use AJAX to fetch the delivery fee from the server
                                    // For demonstration purposes, I'm assuming a simple configuration
                                    var deliveryFees = {
                                        'Gwagwalada': 310.00,
                                        'Kuje': 10.00,
                                        'Abaji': 80.00,
                                        'Bwari':60.00,
                                        'Kwali':100.00,
                                        'Lugbe':200.00,
                                        'Karu':120.00,
                                        'Nyanya':260.00,
                                        'Jabi':200.00,
                                        'Maitama':200.00,
                                        'Wuse':200.00,
                                        'Garki':300.00,
                                        'Asokoro':200.00,
                                        'Wuse II':300.00,
                                        'Utako':200.00,
                                        'Central Business District (CBD)':250.00,
                                        'Kubwa':354.00,
                                         'Gwarimpa':150.00,
                                        
                                    };

                                    return deliveryFees[city] || 0; // Default to 0 if city is not found
                                }
                            </script>
                
                            <div class="form-group">
                                <label for="street_address">Street Address</label>
                                <input type="text" class="form-control" id="street_address" name="street_address" required>
                            </div>
                
                            <div class="form-group">
                                <label for="house_number">House Number</label>
                                <input type="text" class="form-control" id="house_number" name="house_number" required>
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="Nigeria" readonly>
                            </div>

                            <!-- Add more form fields as needed -->

                            <button type="submit" class="btn btn-success">PROCEED TO CHECKOUT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- JavaScript for updating shipping and total -->
<script>
    function updateShippingAndTotal() {
        // Your existing JavaScript logic goes here
        console.log('updateShippingAndTotal function is running');
    }

    function showGuestShippingAddress() {
        document.getElementById('guest-shipping-address').style.display = 'block';
        document.getElementById('proceed-to-checkout').style.display = 'none';
    }

    updateShippingAndTotal();
</script>
@endsection






