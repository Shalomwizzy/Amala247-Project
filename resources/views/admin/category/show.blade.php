@extends('layouts.admin')

@section('content')

<div class="container">

    @if (!$cat)
        <!-- Debugging: Check the value of $cat -->
        <div class="alert alert-danger">Category not found.</div>
    @else
        <p class="h5">{{ $cat->name }}</p>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="{{ asset('categories/' . $cat->image) }}" height="200" class="card-img-top img-fluid" alt="Category Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($cat->name ) }}</h5>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>

@endsection




