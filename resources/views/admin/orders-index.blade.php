@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Orders</h1>
    </div>
    <div class="col-md-6">
        <form action="{{ route('orders.search') }}" method="GET" class="mb-3">
            <div class="input-group container">
                <input type="text" name="order_id" class="form-control input-sm" width="20%" placeholder="Search by Order ID" value="{{ request('order_id') }}">
                <button type="submit" class="btn btn-search">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="container-fluid max-w-max">
  
    <h5>{{ now()->format('l, F j, Y') }}</h5>

    <div class="table-responsive ">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Username</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allOrders->groupBy('order_id') as $orderGroup)
                    @php
                        $paymentMade = false;
                        foreach ($orderGroup as $orderItem) {
                            if ($orderItem->paystack_ref) {
                                $paymentMade = true;
                                break;
                            }
                        }
                    @endphp
                    @if ($paymentMade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $orderGroup->first()->order_id }}</td>
                            <td>{{ $orderGroup->first()->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($orderGroup->first()->order_type === 'USER')
                                    @if ($orderGroup->first()->user && $orderGroup->first()->user->username)
                                        {{ ucfirst($orderGroup->first()->user->username) }}
                                    @else
                                        Guest
                                    @endif
                                @else
                                    Guest
                                @endif
                            </td>
                            <td>&#x20A6;{{ $orderGroup->sum('paid_amount') }}</td>
                            <td>
                                {{ ucfirst($orderGroup->first()->order_status) }}
                                <form action="{{ route('orders.update-status', $orderGroup->first()->order_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="order_status">Update Status:</label>
                                    <select name="order_status" id="order_status">
                                        <option value="placed" {{ $orderGroup->first()->order_status === 'placed' ? 'selected' : '' }}>Order Placed</option>
                                        <option value="dispatched" {{ $orderGroup->first()->order_status === 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                                        <option value="delivered" {{ $orderGroup->first()->order_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="canceled" {{ $orderGroup->first()->order_status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        <!-- Add other status options here -->
                                    </select>
                                    <button class="btn btn-sm btn-outline-success w-" type="submit">Update Status</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('orders.view', $orderGroup->first()->order_id) }}">View&nbsp;Order</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    {!! $allOrders->appends(['page_all_orders' => $allOrders->currentPage()])->links('pagination::bootstrap-5') !!}
</div>
@endsection





















































