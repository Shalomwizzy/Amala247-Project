@extends('layouts.admin')

@section('content')
    <div class="container order-details">
        <h1 class="text-center mb-5">Order Details</h1>

        <div class="row mb-6">
            <div class="col-md-6">
                <h3>Customer Details</h3>
                <h6>Order ID:{{ $orderId }}</h6>
        
                <!-- Display user details -->
                @if($user)
                    <p>First Name: {{ ucfirst($user->first_name) }}</p>
                    <p>Last Name: {{ ucfirst($user->last_name) }}</p>
                    <p>Phone Number: {{ $user->phone_number }}</p>
                    <p>Email: {{ ucfirst($user->email) }}</p>
                @endif
        
                <!-- Display guest details -->
                @if($guest)
                    <p>First Name: {{ ucfirst($guest->first_name) }}</p>
                    <p>Last Name: {{ ucfirst($guest->last_name) }}</p>
                    <p>Phone Number: {{ $guest->phone_number }}</p>
                    <p>Email: {{ ucfirst($guest->email) }}</p>
                @endif
        
                <!-- Handle case when both $user and $guest are null -->
                @if(!$user && !$guest)
                    <p>No customer details found.</p>
                @endif
            </div>
            <div class="col-md-6">
                <h3>Shipping Address</h3>
        
                <!-- Debug shipping address -->
                {{-- {{ dd($address) }} --}}
        
                <!-- Display shipping address -->
                @if($user && $address)
                    <p>Street Address: {{ ucfirst($address->street_address) }}</p>
                    <p>House Number: {{ ucfirst($address->house_number) }}</p>
                    <p>City: {{ ucfirst($address->city) }}</p>
                    <p>State: {{ ucfirst($address->state) }}</p>
                @elseif($guest)
                    <p>Street Address: {{ ucfirst($guest->street_address) }}</p>
                    <p>House Number: {{ ucfirst($guest->house_number) }}</p>
                    <p>City: {{ ucfirst($guest->city) }}</p>
                    <p>State: {{ ucfirst($guest->state) }}</p>
                @else
                    <p>No Shipping Address</p>
                @endif
            </div>
        </div>
        
        <h5 class="text-center">Order ID:{{ $orderId }}</h5>
        <!-- Display order items -->
        <hr>
        <h3>Order Items</h3>
        <div class="table-responsive">
            @if ($orderItems->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product&nbsp;Image</th>
                            <th>Product&nbsp;Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Coupon&nbsp;Code</th>
                            <th>Coupon&nbsp;Amount</th>
                            <th>Paystack&nbsp;Reference</th>
                            <th>Paid&nbsp;Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>
                                    @if ($orderItem->product && $orderItem->product->product_image)
                                        <img src="{{ asset($orderItem->product->product_image) }}" alt="Product Image" width="100">
                                    @else
                                        No Image Available
                                    @endif
                                </td>
                                <td>
                                    @if ($orderItem->product)
                                        {{ ucfirst($orderItem->product->product_name) }}
                                    @else
                                        Product Not Available
                                    @endif
                                </td>
                                <td>{{ $orderItem->amount }}</td>
                                <td>
                                    @if ($orderItem->order_type === 'USER' && $orderItem->userOrder && $orderItem->userOrder->order_status)
                                        {{ ucfirst($orderItem->userOrder->order_status) }}
                                    @elseif ($orderItem->order_type === 'GUEST' && $orderItem->guestOrder && $orderItem->guestOrder->order_status)
                                        {{ ucfirst($orderItem->guestOrder->order_status) }}
                                    @endif
                                </td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>
                                    @if ($orderItem->order_type === 'USER')
                                        @if ($orderItem->userOrder->coupon_code)
                                            {{ $orderItem->userOrder->coupon_code }}
                                        @else
                                            No coupon used
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($orderItem->order_type === 'USER')
                                        @if ($orderItem->userOrder->coupon_amount)
                                            {{ $orderItem->userOrder->coupon_amount }}
                                        @else
                                            -
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($orderItem->order_type === 'USER')
                                        {{ $orderItem->userOrder->paystack_ref }}
                                    @elseif ($orderItem->order_type === 'GUEST')
                                        {{ $orderItem->guestOrder->paystack_ref }}
                                    @endif
                                </td>
                                <td>
                                    @if ($orderItem->order_type === 'USER')
                                        {{ number_format($orderItem->userOrder->paid_amount, 2) }}
                                    @elseif ($orderItem->order_type === 'GUEST')
                                        {{ number_format($orderItem->guestOrder->paid_amount, 2) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No order items found.</p>
            @endif
        </div>
    </div>
@endsection












