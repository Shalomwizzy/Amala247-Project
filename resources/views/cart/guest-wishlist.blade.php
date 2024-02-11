@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Your Wishlist</h1>

    <div class="row">
        <div class="col-md-8 mt-5 align-self-center">
            @if (count($wishlistItems) > 0)
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
                        @foreach ($wishlistItems as $item)
                        <tr>
                            <td>
                                @if (isset($item['product']->product_image))
                                    <img src="{{ asset($item['product']->product_image) }}" alt="Product Image" width="100">
                                @else
                                    <span>Image Unavailable</span>
                                @endif
                            </td>
                            <td>
                                @if (isset($item['product']->product_name))
                                    {{ $item['product']->product_name }}
                                @else
                                    <span>Product Name Unavailable</span>
                                @endif
                            </td>
                            <td>
                                @if (isset($item['product']->product_price))
                                    ₦{{ number_format($item['product']->product_price, 2) }}
                                @else
                                    <span>Price Unavailable</span>
                                @endif
                            </td>
                            <td>
                                <!-- Add a form to order the product -->
                                <form action="{{ route('cart.add', ['product' => $item['product_id']]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <input type="hidden" name="product_name" value="{{ $item['product']->product_name }}">
                                    <input type="hidden" name="product_price" value="{{ $item['product']->product_price }}">
                                    <button type="submit" class="btn btn-outline-danger">Order Now</button>
                                </form>
                            </td>
                            <td>
                                <!-- Add a form to remove the product from the wishlist -->
                                <form action="{{ route('wishlist.remove', ['id' => $item['product_id']]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       
            @else
            <p class="text-center">No items in the wishlist.</p>
        @endif
        
        </div>
    </div>
</div>
@endsection
