<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create()
    {
        $reviews = Review::latest('created_at')->paginate(8);
    //  dd($reviews);
    
        return view('user.reviews', compact('reviews'));
    }


    public function adminView()
    {
        $reviews = Review::latest('created_at')->paginate(8);
    //  dd($reviews);
    
        return view('admin/reviews.view', compact('reviews'));
    }
    
    



    // public function showFeedback()
    // {
    //     $reviews = Review::with('user')->latest()->paginate(10); // Change 10 to the desired number of reviews per page
    //     return view('feedback', compact('reviews'));
    // }
    


public function store(Request $request)
{
    // Check if the user is authenticated
    if (!auth()->check()) {
        return redirect()->back()->with('error', 'You need to login to submit a review.');
    }

    $request->validate([
        'text' => 'required',
        'rating' => 'required|integer|between:1,5', 
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('review_images', 'public');
    }

    $review = Review::create([
        'user_id' => auth()->user()->id,
        'text' => $request->input('text'),
        'rating' => $request->input('rating'),
        'image' => $imagePath,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully.');
}




public function reply($id, Request $request)
{
    $review = Review::findOrFail($id);

    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'reply_review' => 'required|string',
    ]);

    $review->reply_review = $request->input('reply_review');
    $review->save();

    return redirect()->back()->with('success', 'Reply added successfully.');
}





public function showReplyForm($id)
{
    $review = Review::findOrFail($id);

    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return abort(403, 'Unauthorized action.');
    }

    return view('admin/reviews.reply', compact('review'));
}



public function adminIndex()
{
    $reviews = Review::with('user')->latest()->paginate(10); 
    return view('admin.reviews.index', compact('reviews'));
}


public function destroy($id)
{
    $review = Review::findOrFail($id);

  
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return abort(403, 'Unauthorized action.');
    }

  
    $review->delete();

    return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
}






}


