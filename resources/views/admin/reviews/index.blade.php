<!-- resources/views/admin/reviews/index.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Manage Reviews</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{ $review->user->username }}</td>
                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span style="color: {{ $i <= $review->rating ? '#ffca08' : '#aaa' }};">&#9733;</span>
                                                @endfor
                                            </td>
                                            <td style="max-width: 200px; word-wrap: break-word;">{{ $review->text }}</td>
                                            <td class="d-flex">
                                                <!-- Reply Form -->
                                                <form action="{{ route('admin.reviews.reply', $review->id) }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success me-2">Reply</button>
                                                </form>
                                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="post" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



