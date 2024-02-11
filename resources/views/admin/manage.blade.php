@extends('layouts.admin')

@section('content')
<div class="container Manage">
    <h1>Manage Reviews</h1>
    
    <div class="row">
        @foreach ($reviews as $review)
        <div class="col-md-6">
            <div class="card mb-4 Manage">
                <div class="card-body">
                    <h5 class="card-title Manage">Review by {{ $review->user->username }}</h5>
                    <p class="card-text Manage">{{ $review->text }}</p>
                    <form action="{{ route('admin.delete-review', $review->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger Manage">Delete Review</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            {!! $reviews->links('pagination::bootstrap-5', ['class' => 'Manage']) !!}
        </div>
    </div>
</div>

<link href="{{ asset('css/manage-reviews.css') }}" rel="stylesheet">

@endsection





