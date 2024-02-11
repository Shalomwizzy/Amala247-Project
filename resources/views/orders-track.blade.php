{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Order Tracking Page</h1>
        <p class="text-center mb-4">You can always check the status of your order here. Please enter your 8-digit order ID to see the status of your order.</p>


        <div class="track-form-details">
            <form action="{{ route('order.track') }}" method="POST" class="track-form">
                @csrf
                <div class="mb-3">
                    <label for="order_id" class="form-label track-form-label">Enter Your 8-Digit Order ID:</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Track Order</button>
            </form>
        </div>


        

        @isset($order)
            
            <div class="order-details">
                <h2>Order Details</h2>
                <table class="order-details-table">
                    <tr>
                        <th>Order Placed</th>
                        <th>Total</th>
                        <th>Ship To</th>
                        <th>Order ID</th>
                    </tr>
                    <tr>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>&#x20A6;{{ number_format($order->paid_amount, 2) }}</td>
                        <td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                        <td>{{ $order->order_id }}</td>
                    </tr>
                </table>
                <div class="mt-4 text-center">
                    <strong>Order Status: {{ ucfirst($order->order_status) }}</strong>
                </div>

                <div class="progress-container">
                    @if ($order->order_status === 'order placed')
                        <!-- First Line -->
                        <div class="progress-bar">
                            <div class="progress-red"></div>
                            <div class="progress-icons">
                                <i class="fa-solid fa-cart-shopping shopping-icon"></i>
                            </div>
                            <div class="progress-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    @elseif ($order->order_status === 'dispatched')
                        <!-- Second Line -->
                        <div class="custom-bar">
                            <div class="custom-red-check" style="width: 66.6%;"></div>
                            <div class="custom-icons-cart">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <div class="custom-icons-motorcycle">
                                <i class="fa-solid fa-motorcycle motorcycle-icon"></i>
                            </div>
                            <div class="custom-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    @elseif ($order->order_status === 'delivered')
                        <!-- Third Line -->
                        <div class="final-bar">
                            <div class="final-red-check" style="width: 100%;"></div>
                            <div class="final-icons-cart">
                                <i class="fa-solid fa-cart-shopping cart-icon"></i>
                            </div>
                            <div class="final-icons-motorcycle">
                                <i class="fa-solid fa-motorcycle motorcycle-icon"></i>
                            </div>
                            <div class="final-icons-check">
                                <i class="fa-solid fa-check check-icon"></i>
                            </div>
                            <div class="final-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    @elseif ($order->order_status === 'canceled')
                        <!-- Fourth Line -->
                        <div class="canceled-bar">
                            <div class="canceled-red-check" style="width: 100%;"></div>
                            <div class="canceled-icons">
                                <i class="fa-solid fa-times canceled-icon"></i>
                            </div>
                            <div class="canceled-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Canceled</span>
                            </div>
                        </div>
                    @endif
                </div>
                

   

            </div>
        @endisset
    </div>
@endsection --}}






@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Order Tracking Page</h1>
        <p class="text-center mb-4">You can always check the status of your order here. Please enter your 8-digit order ID to see the status of your order.</p>

        <div class="track-form-details">
            <form action="{{ route('order.track') }}" method="POST" class="track-form">
                @csrf
                <div class="mb-3">
                    <label for="order_id" class="form-label track-form-label">Enter Your 8-Digit Order ID:</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Track Order</button>
            </form>
        </div>

        @isset($order)
            <div class="order-details">
                <h2>Order Details</h2>
                <table class="order-details-table">
                    <tr>
                        <th>Order Placed</th>
                        <th>Total</th>
                        <th>Ship To</th>
                        <th>Order ID</th>
                    </tr>
                    <tr>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>&#x20A6;{{ number_format($order->paid_amount, 2) }}</td>
                        <td>
                            @if($order->user)
                                {{ $order->user->first_name . ' ' . $order->user->last_name }}
                            @else
                                {{ $order->guest->first_name . ' ' . $order->guest->last_name }}
                            @endif
                        </td>
                        
                        <td>{{ $order->order_id }}</td>
                    </tr>
                </table>
                <div class="mt-4 text-center">
                    <strong>Order Status: {{ ucfirst($order->order_status) }}</strong>
                </div>

                <div class="progress-container">
                    @if ($order->order_status === 'order placed')
                        <!-- First Line -->
                        <div class="progress-bar">
                            <div class="progress-red"></div>
                            <div class="progress-icons">
                                <i class="fa-solid fa-cart-shopping shopping-icon"></i>
                            </div>
                            <div class="progress-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    @elseif ($order->order_status === 'dispatched')
                        <!-- Second Line -->
                        <div class="custom-bar">
                            <div class="custom-red-check" style="width: 66.6%;"></div>
                            <div class="custom-icons-cart">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <div class="custom-icons-motorcycle">
                                <i class="fa-solid fa-motorcycle motorcycle-icon"></i>
                            </div>
                            <div class="custom-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    @elseif ($order->order_status === 'delivered')
                        <!-- Third Line -->
                        <div class="final-bar">
                            <div class="final-red-check" style="width: 100%;"></div>
                            <div class="final-icons-cart">
                                <i class="fa-solid fa-cart-shopping cart-icon"></i>
                            </div>
                            <div class="final-icons-motorcycle">
                                <i class="fa-solid fa-motorcycle motorcycle-icon"></i>
                            </div>
                            <div class="final-icons-check">
                                <i class="fa-solid fa-check check-icon"></i>
                            </div>
                            <div class="final-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Delivered</span>
                            </div>
                        </div>
                    @elseif ($order->order_status === 'canceled')
                        <!-- Fourth Line -->
                        <div class="canceled-bar">
                            <div class="canceled-red-check" style="width: 100%;"></div>
                            <div class="canceled-icons">
                                <i class="fa-solid fa-times canceled-icon"></i>
                            </div>
                            <div class="canceled-labels">
                                <span>Order Placed</span>
                                <span>Dispatched</span>
                                <span>Canceled</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endisset
    </div>
@endsection















