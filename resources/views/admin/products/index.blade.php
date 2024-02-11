@extends('layouts.admin')

@section('content')
<section>
    <div class="container product-list">
        <div class="row mt-5 gap-5">
            @forelse ($products as $product)
            <div class="card col-lg-3 col-md-6 mb-4 d-flex flex-column">
                <a href="#">
                    <img src="{{ asset($product->product_image) }}" class="card-img-top p-2" alt="{{ $product->product_name }}">
                </a>
                <div class="product-name flex-grow-1">
                    
                        {{ ucfirst($product->product_name) }}
                    
                    <span class="">&#x20A6;{{ $product->product_price }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No products available.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection





















