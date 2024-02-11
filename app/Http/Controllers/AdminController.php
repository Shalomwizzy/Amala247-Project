<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\CouponCode;
use App\Models\GuestOrder;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\Review;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function adminWelcome()
    {
        $totalUsers = User::count();
    
        $totalProducts = Products::count();
    
        
        $totalOrders = UserOrder::where('paid_amount', '>', 0)->count();
    
        $totalRevenue = 0;
    
       
        $totalRevenue += UserOrder::where('paid_amount', '>', 0)->sum('paid_amount');
    
     
        $totalRevenue += GuestOrder::where('paid_amount', '>', 0)->sum('paid_amount');
    
        $recentUsers = User::latest()->take(2)->get();
    
        $recentReviews = Review::latest()->take(3)->get();
    
        return view('admin.welcome-admin', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'recentUsers' => $recentUsers,
            'recentReviews' => $recentReviews,
        ]);
    }
    
    
    




    



    public function admin(){
        return view('admin_home');
    }

    public function adminNav(){
        return view('partials.admin-nav');
    }


    public function createWorker()
    {
        return view('admin.workers.create-user');
    }

    public function storeUser(Request $request)
{
    
    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,manager,salesperson',
    
    ]);

    // Create a new user
    $user = new User();
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];
    $user->password = bcrypt($validatedData['password']);
    $user->role = $validatedData['role'];
    $user->save();

  
    return redirect()->back()->with('success', 'User created successfully!');
}






    public function showUsers()
    {
        $users = User::paginate(20); // Retrieve and paginate users from the database
        return view('admin/users.index', compact('users'));
    }



    public function update(Request $request, User $user)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:20',
        'street_address' => 'nullable|string|max:255',
        'house_number' => 'nullable|string|max:20',
        'city' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
     
    ]);

    // Update user details
    $user->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone_number'),
    ]);

    // Update or create user address
    $user->userAddress()->updateOrCreate([], [
        'street_address' => $request->input('street_address'),
        'house_number' => $request->input('house_number'),
        'city' => $request->input('city'),
        'state' => $request->input('state'),
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User details updated successfully');
}


public function edit(User $user)
{
    return view('admin/users.edit', compact('user'));
}

public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
}


    public function salesChart(Request $request)
    {
        // Get the selected month from the request, default to the current month
        $selectedMonth = $request->input('selectedMonth', Carbon::now()->format('Y-m'));
    
        // Get total orders and revenue for each month for users
        $monthlyUserData = UserOrder::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('count(*) as total_orders'),
                DB::raw('sum(total) as total_amount')
            )
            ->where('order_type', 'user') // Assuming you have an 'order_type' column to distinguish between user and guest orders
            ->when($selectedMonth, function ($query, $selectedMonth) {
                return $query->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $selectedMonth);
            })
            ->groupBy('month')
            ->get();
    
        // Get total orders and revenue for each month for guests
        $monthlyGuestData = GuestOrder::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('count(*) as total_orders'),
                DB::raw('sum(total) as total_amount')
            )
            ->when($selectedMonth, function ($query, $selectedMonth) {
                return $query->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $selectedMonth);
            })
            ->groupBy('month')
            ->get();
    
        // Prepare data for chart
        $months = $monthlyUserData->pluck('month');
        $totalOrdersUsers = $monthlyUserData->pluck('total_orders');
        $totalAmountUsers = $monthlyUserData->pluck('total_amount');
    
        $totalOrdersGuests = $monthlyGuestData->pluck('total_orders');
        $totalAmountGuests = $monthlyGuestData->pluck('total_amount');
    
        // Get all distinct months for the dropdown
        $allMonths = UserOrder::select(DB::raw("DISTINCT DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->union(GuestOrder::select(DB::raw("DISTINCT DATE_FORMAT(created_at, '%Y-%m') as month")))
            ->orderBy('month', 'desc')
            ->pluck('month');
    
        return view('admin.sales-chart', compact('months', 'totalOrdersUsers', 'totalAmountUsers', 'totalOrdersGuests', 'totalAmountGuests', 'allMonths', 'selectedMonth'));
    }

 
 

    
}
