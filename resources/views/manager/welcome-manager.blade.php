

@extends('layouts.manager')

@section('content')
<div class="container welcome-admin">
    <h1>Welcome, Manager!</h1>
    <p>Welcome to the Manager dashboard. Here, you can manage various aspects of the system.</p>
    
    
    <div class="admin-stats">
        <h2>Statistics</h2>
        <p>Total Users: <strong>{{ $totalUsers }}</strong></p>
        <p>Total Products: <strong>{{ $totalProducts }}</strong></p>
        <p>Total Orders: <strong>{{ $totalOrders }}</strong></p>
        <p>Total Revenue: <strong>₦{{ $totalRevenue }}</strong></p>
    </div>

    <div class="admin-recent-info">
      
        
        <div class="recent-users">
            <h6>Recent Users</h6>
            <ul>
                @foreach ($recentUsers as $user)
                    <li>
                        Name: {{ $user->username }} | Email: {{ $user->email }}
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="recent-reviews">
            <h6>Recent Reviews</h6>
            <ul>
                @foreach ($recentReviews as $review)
                    <li>
                        Review message: {{ $review->text }} | User: {{ $review->user->username }} | Rating: {{ $review->rating }}
                    </li>
                @endforeach
            </ul>
        </div>
        
    </div>
    
</div>


<style>
    
    .welcome-admin{
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .welcome-admin h1 {
        color: #333;
    }
    .welcome-admin p {
        color: #666;
    }
    .admin-stats {
        margin-top: 30px;
    }
    .admin-activities {
        margin-top: 30px;
    }
</style>

@endsection