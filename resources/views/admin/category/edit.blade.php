@extends('layouts.admin')

@section('content')

<div class="container py-5 edit-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card edit-card">
                <div class="card-header edit-card-header">Edit Category</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}" enctype="multipart/form-data"> 
                        @csrf
                        @method('put')
                        <div class="form-group edit-form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">

                            <label for="file">Category Image</label>
                            <input type="file" name="image" accept="image/*" class="form-control" id="file">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn edit-btn">Update Category</button>
                            <a href="" class="btn edit-cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
