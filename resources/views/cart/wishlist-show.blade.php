@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Your Wishlist</h1>

    <div class="row">
        <div class="col-md-8 mt-5 align-self-center">
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Order Now</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wishlistItems as $item)
                        <tr>
                            <td>
                                @if (isset($item['product_image']))
                                    <img src="{{ asset($item['product_image']) }}" alt="Product Image" width="100">
                                @elseif (isset($item['product']) && isset($item['product']->product_image))
                                    <img src="{{ asset($item['product']->product_image) }}" alt="Product Image" width="100">
                                @endif
                            </td>
                            <td>
                                @if (isset($item['product_name']))
                                    {{ $item['product_name'] }}
                                @elseif (isset($item['product']) && isset($item['product']->product_name))
                                    {{ $item['product']->product_name }}
                                @else
                                    Product Name Unavailable
                                @endif
                            </td>
                            <td>
                                @if (isset($item['product_price']))
                                    ₦{{ number_format($item['product_price'], 2) }}
                                @elseif (isset($item['product']) && isset($item['product']->product_price))
                                    ₦{{ number_format($item['product']->product_price, 2) }}
                                @else
                                    Price Unavailable
                                @endif
                            </td>
                            <td>
                                <!-- Add a form to order the product -->
                                @if (isset($item['product_id']))
                                    <form action="{{ route('cart.add', ['product' => $item['product_id']]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                        @if (isset($item['product_name']))
                                            <input type="hidden" name="product_name" value="{{ $item['product_name'] }}">
                                        @endif
                                        @if (isset($item['product_price']))
                                            <input type="hidden" name="product_price" value="{{ $item['product_price'] }}">
                                        @endif
                                        <button type="submit" class="btn btn-outline-danger">Order&nbsp;Now</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <!-- Add a form to remove the product from the wishlist -->
                                @if (isset($item['product_id']))
                                    <form action="{{ route('wishlist.remove', ['id' => $item['product_id']]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No items in the wishlist.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



















