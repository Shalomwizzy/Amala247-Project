@extends('layouts.admin')

@section('content')
    <div class="container" style="padding: 30px 0;">
        <div class="d-flex justify-content-center align-items-center" style="">
            <div class="w-55">
                <h2 class="text-center">All Coupons</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>Coupon Value</th>
                                <th>Cart Value</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ ucfirst($coupon->code) }}</td>
                                    <td>{{ ucfirst($coupon->type) }}</td>
                                    @if ($coupon->type == 'fixed')
                                    <td>{{ $coupon->value }}</td>
                                    @else
                                    <td>{{ $coupon->value }} %</td>
                                    @endif
                                    <td>{{ $coupon->cart_value }}</td>
                                    <td>{{ $coupon->expiry_date }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('coupon.show', ['id' => $coupon->id]) }}" class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ route('coupon.edit', ['coupon_id' => $coupon->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                                            <form onsubmit="return confirm('Are you sure?')" 
                                                action="{{ route('coupon.destroy', ['id' => $coupon->id]) }}"
                                                method="post" class="d-inline">
                                                @csrf 
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No coupons found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <strong class="pagination-container"> {!! $coupons->links('pagination::bootstrap-5') !!}</strong>
            </div>
        </div>
    </div>
@endsection





