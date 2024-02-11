<!-- resources/views/reviews/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- "Create a Review" Form -->
                <div class="card" id="createReviewContainer" style="display: none;">
                    <div class="card-header text-center">
                        <h3>Create a Review</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" id="reviewForm">
                            @csrf

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="mb-3">
                                <label for="text" class="form-label">Review Text</label>
                                <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <div class="rating" id="starRating">
                                    <!-- Your star rating inputs go here -->
                                    @for ($i = 5; $i >= 1; $i--)
                                        <span class="star" data-rating="{{ $i }}" title="{{ $i }} stars">&#9733;</span>
                                    @endfor
                                    <input type="hidden" name="rating" id="selectedRating" value="0">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>

                <!-- "Write a Review" Button -->
                <div class="mb-3 text-end">
                    <span id="writeReviewBtn" class="btn btn-sm btn-primary" style="cursor: pointer;">
                        <i class="fas fa-pen"></i> Write a Review
                    </span>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-8">
                    <div class="card-header">
                        <h3>Reviews</h3>
                        @php
                            $totalReviews = $reviews->count();
                            $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;
                            $fullStars = floor($averageRating);
                            $remainingStars = 5 - $fullStars;
                        @endphp
            
                        <div class="rating" style="font-size: 16px; margin-bottom: 10px;">
                            {{ number_format($averageRating, 1) }}
                            @for ($i = 1; $i <= $fullStars; $i++)
                                <span style="color: #ffca08;">&#9733;</span>
                            @endfor
            
                            @for ($i = 1; $i <= $remainingStars; $i++)
                                <span style="color: #aaa;">&#9733;</span>
                            @endfor
            
                            Over {{ $totalReviews }} Reviews
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($reviews->reverse()->chunk(2) as $chunkedReviews)
                            <div class="row">
                                @foreach($chunkedReviews as $review)
                                    <div class="col-md-6 mb-4">
                                        <div class="d-flex align-items-start">
                                            <div style="margin-right: 10px;">
                                                <img src="{{ $review->user->profile_picture }}" alt="{{ $review->user->username }}" style="width: 50px; height: 50px; border-radius: 50%;" class="review-image">
                                            </div>
                                            <div>
                                                <strong style="white-space: nowrap;">{{ $review->user->username }}</strong>
                                                <br>
                                                <span class="number-of-reviews">
                                                    {{ optional($review->user->reviews)->count() }}
                                                    @if (optional($review->user->reviews)->count() == 1)
                                                        Review
                                                    @else
                                                        Reviews
                                                    @endif
                                                </span>
                                                
                                                 
                                                    
                                               
            
                                                <div class="rating" style="font-size: 14px; margin-bottom: 0;">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span style="color: {{ $i <= $review->rating ? '#ffca08' : '#aaa' }};">&#9733;</span>
                                                    @endfor
                                                    <span>{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-and-reply">
                                            <h6 style="margin: 0; padding: 0;" class="review-text">
                                                <span id="reviewText{{ $review->id }}" class="full-text">
                                                    {!! strlen($review->text) > 50 ? substr($review->text, 0, 50) . '<span id="more'.$review->id.'" class="full-text" style="display:none;">' . substr($review->text, 50) . '</span>' : $review->text !!}
                                                </span>
                                                <span id="dots{{ $review->id }}">...</span>
                                                @if (strlen($review->text) > 50)
                                                    <button onclick="showMore('{{ $review->id }}')" id="moreBtn{{ $review->id }}" class="btn-link">More</button>
                                                    <button onclick="showLess('{{ $review->id }}')" id="lessBtn{{ $review->id }}" class="btn-link" style="display:none;">Less</button>
                                                @endif
                                            </h6>
                                            
                                            @if ($review->reply_review)
                                                <div class="text-primary admin-response">
                                                   <span class="admin-response-text">
                                                    Admin's Response: {{ $review->updated_at->diffForHumans() }}
                                                   </span>
                                                    <h6 class="admin-review-reply">{{ $review->reply_review }}</h6>
                                                </div>
                                            @endif
                                        </div>
                                        
                                    </div>
                                @endforeach
                            </div>
                            
                        @endforeach
                    </div>
                    <div class="text-center mb-4 text-sm-center">
                        {{ $reviews->links('vendor.pagination.simple-tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div> 

  
    
    
    







<script>
    function showMore(reviewId) {
    var moreText = document.getElementById("more" + reviewId);
    var lessBtn = document.getElementById("lessBtn" + reviewId);
    var moreBtn = document.getElementById("moreBtn" + reviewId);

    moreText.style.display = "inline";
    lessBtn.style.display = "inline";
    moreBtn.style.display = "none";
}

function showLess(reviewId) {
    var moreText = document.getElementById("more" + reviewId);
    var lessBtn = document.getElementById("lessBtn" + reviewId);
    var moreBtn = document.getElementById("moreBtn" + reviewId);

    moreText.style.display = "none";
    lessBtn.style.display = "none";
    moreBtn.style.display = "inline";
}


document.addEventListener('DOMContentLoaded', function () {

var writeReviewBtn = document.getElementById('writeReviewBtn');
var createReviewContainer = document.getElementById('createReviewContainer');

writeReviewBtn.addEventListener('click', function () {
  
    createReviewContainer.style.display = (createReviewContainer.style.display === 'none' || createReviewContainer.style.display === '') ? 'block' : 'none';
});
});

  
document.getElementById('starRating').addEventListener('click', function (event) {
    var clickedStar = event.target;
    var rating = clickedStar.getAttribute('data-rating');

    document.getElementById('selectedRating').value = rating;

    var stars = document.querySelectorAll('.rating span');
    stars.forEach(function (star) {
        var starRating = star.getAttribute('data-rating');
        star.style.color = starRating <= rating ? '#ffca08' : '#aaa';
    });
});
</script>
    

    
@endsection








