@extends('layouts.admin') <!-- Assuming you have a layout file for the admin page -->

@section('content')
<div class="container">
    <div class="row justify-content-center product-form">
        <div class="col-md-6">
            <h1 class="text-center">Create New Product</h1>
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="product-form">
                @csrf
                <!-- Product Category -->
                <div class="form-group">
                    <label for="category">Product Category:</label>
                    <select name="product_category" id="category" class="form-select"> <!-- Corrected name attribute -->
                        @forelse ($categories as $category )
                        <option value="{{ $category->id }}">{{ ucfirst($category->name )}}</option> <!-- Changed array access to object access -->
                        @empty
                         <option disabled>No Categories Available</option>
                        @endforelse
                    </select>
                </div>

                <!-- Product Name -->
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>

                <!-- Product Price -->
                <div class="form-group">
                    <label for="product_price">Product Price:</label>
                    <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
                </div>

                <!-- Product Images -->
                <div class="form-group">
                    <label for="product_image">Product Image:</label>
                    <input type="file" class="form-control-file" id="product_image" name="product_image"  required>
                </div>

                <!-- Button to Create Product -->
                <div class="text-center">
                    <button type="submit" class="btn product-createbtn">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection




