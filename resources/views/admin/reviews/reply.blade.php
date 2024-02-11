<!-- resources/views/admin/reviews/reply.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Reply to Review</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>User: {{ $review->user->username }}</strong>
                        </div>
                        <div class="mb-3">
                            <strong>Rating:</strong>
                            @for ($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= $review->rating ? '#ffca08' : '#aaa' }};">&#9733;</span>
                            @endfor
                        </div>
                        <div class="mb-3">
                            <strong>Review:</strong>
                            {{ $review->text }}
                        </div>
                        <div class="mb-3">
                            <strong>Number of Reviews by User:</strong>
                            {{ optional($review->user->reviews)->count() }}
                        </div>
                        <form action="{{ route('admin.reviews.reply', $review) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="reply _review">Your Reply</label>
                                <textarea name="reply_review" id="reply_review" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Reply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


