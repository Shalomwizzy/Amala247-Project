@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="product-edit">
                <h1 class="text-center fs-3">Edit Product</h1>
                <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ ucfirst($product->product_name) }}">
                    </div>

                    <!-- Product Price -->
                    <div class="form-group">
                        <label for="product_price">Product Price:</label>
                        <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price }}">
                    </div>

                    <!-- Product Image -->
                    <div class="form-group">
                        <label for="product_image">Product Image:</label>
                        <input type="file" class="form-control-file" id="product_image" name="product_image">
                    </div>

                    <!-- Display current image if available -->
                    @if($product->product_image)
                        <div class="form-group">
                            <label>Current Product Image:</label>
                            <img src="{{ asset('path/to/your/images/' . $product->product_image) }}" alt="Current Image" class="img-fluid">
                        </div>
                    @endif

                    <!-- Save and Cancel Buttons -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success save-button">Save Changes</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection






