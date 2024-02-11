@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid product-image">
        </div>
        <div class="col-md-6">
            <h2>{{ strtoupper($product->product_name) }}</h2>
            <h2>&#x20A6;{{ number_format($product->product_price, 2) }}</h2>
            <div class="d-flex align-items-center my-3">
                <button class="btn btn-secondary minus">-</button>
                <span class="quantity-input mx-2">1</span>
                <button class="btn btn-secondary plus">+</button>

                <button class="btn btn-primary ml-auto m-3 addToCart">Add to Cart</button>

                <button class="btn btn-secondary ml-3 m-2"><i class="fa-solid fa-heart"></i></button>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <h3>Related Products</h3>
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <a href="{{ route('product.details', ['product' => $relatedProduct->id]) }}">
                            <img src="{{ asset($relatedProduct->product_image) }}" alt="{{ $relatedProduct->product_name }}" class="card-img-top">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">{{ $relatedProduct->product_name }}</h6>
                            <h3 class="card-text">&#x20A6;{{ number_format($relatedProduct->product_price, 2) }}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".minus").click(function() {
            var quantitySpan = $(this).siblings(".quantity-input");
            var value = parseInt(quantitySpan.text());
            if (value > 1) {
                quantitySpan.text(value - 1);
            }
        });

        $(".plus").click(function() {
            var quantitySpan = $(this).siblings(".quantity-input");
            var value = parseInt(quantitySpan.text());
            quantitySpan.text(value + 1);
        });

        $(".addToCart").click(function() {
            var quantity = parseInt($(".quantity-input").text());
            // Add your cart functionality here using the 'quantity' variable
        });
    });
</script>
@endsection






{{-- <style>
    .quantity {
    display: flex;
    align-items: center;
}

.quantity-input {
    margin: 0 5px;
    width: 50px;
    text-align: center;
}

.product-image {
    max-width: 100%;
    height: auto;
}

</style> --}}
