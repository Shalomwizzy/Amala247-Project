@extends('layouts.admin')

@section('content')

<div class="container py-5 create-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card create-card">
                <div class="card-header create-card-header">Create Category</div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group create-form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn create-btn">Create Category</button>
                            <a href="" class="btn create-cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection