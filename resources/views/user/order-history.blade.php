@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/history.css') }}" rel="stylesheet">

    <section>
        <div class="order-history container">
            <h1 class="order-history-heading">Order History</h1>

            <div class="table-responsive order-his">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th class="pi">Product&nbsp;Image</th>
                            <th class="pn">Product&nbsp;Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (Auth::user()->orders()->latest()->paginate(5) as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>
                                    @if ($order->product && $order->product->product_image)
                                        <img src="{{ asset($order->product->product_image) }}" alt="Product Image" width="100">
                                    @else
                                        No Image Available
                                    @endif
                                </td>
                                <td>
                                    @if ($order->product)
                                        {{ $order->product->product_name }}
                                    @else
                                        Product Not Available
                                    @endif
                                </td>
                                <td>{{ $order->quantity }}</td>
                                <td>
                                    @if ($order->product)
                                        &#x20A6;{{ number_format($order->product->product_price * $order->quantity, 2) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ Str::title($order->order_status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <p class="order-history-message">No order has been made yet. <a href="{{ route('shop') }}">Browse Products</a></p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {!! Auth::user()->orders()->latest()->paginate(5)->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </section>
@endsection

