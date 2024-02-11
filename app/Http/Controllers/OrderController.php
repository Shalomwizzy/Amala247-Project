<?php

namespace App\Http\Controllers;

use App\Models\GuestOrder;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{


    
    public function index()
    {
        $userOrders = UserOrder::with(['user', 'items.product'])
            ->latest('created_at')
            ->get(); // Fetch all user orders
    
        $guestOrders = GuestOrder::with(['guest', 'items.product'])
            ->latest('created_at')
            ->get(); // Fetch all guest orders
    
        // Combine and sort user and guest orders
        $allOrders = $userOrders->concat($guestOrders)->sortByDesc('created_at');
    
        // Use paginate for the combined orders
        $allOrders = $this->paginate($allOrders, 10, 'page_all_orders');
    
        return view('admin.orders-index', compact('allOrders'));
    }
    
    
    
    
    
    

    
    public function viewOrder($orderId)
    {
        $order = Order::find($orderId);
    
        if ($order) {
            $order->update(['is_read' => true]);
            // Other view logic...
        } else {
            // Handle case where order with given ID is not found
            return redirect()->route('orders.index')->with('error', 'Order not found.');
            // Alternatively, you can display an error message or perform any other necessary action.
        }
    }
        
    




    


    private function paginate($items, $perPage = 10, $pageName = 'page', $page = null, $additionalParams = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage($pageName) ?: 1);
    
        // Merge additional parameters, such as search, with the paginator
        $queryParameters = array_merge(request()->query(), $additionalParams);
    
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ] + $queryParameters // Include additional parameters in the paginator
        );
    }
    
    
    


    



    
    public function updateStatus(Request $request, $order_id)
    {
        $request->validate([
            'order_status' => 'required|in:dispatched,delivered,canceled,',
        ]);
    
        try {
            // Update the status for all associated user orders using the order ID
            UserOrder::where('order_id', $order_id)
                ->update(['order_status' => $request->order_status]);
    
            // Update the status for all associated guest orders using the order ID
            GuestOrder::where('order_id', $order_id)
                ->update(['order_status' => $request->order_status]);
    
            return redirect()->route('orders.index')->with('success', 'Order status updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->route('orders.index')->with('error', 'Error updating order status.');
        }
    }
    
    
    
    public function showOrderDetails($orderId)
    {
        // Retrieve all order items with details
        $orderItems = $this->getOrderItemsWithDetails($orderId);
    
        // Separate UserOrders and GuestOrders
        $userOrders = $orderItems->where('order_type', 'USER');
        $guestOrders = $orderItems->where('order_type', 'GUEST');
    
        // Retrieve user and address details
        $user = $userOrders->isNotEmpty() ? optional($userOrders->first()->userOrder->user) : null;
        $address = $userOrders->isNotEmpty() ? optional($userOrders->first()->userOrder->userAddress) : null;
    
        // Retrieve guest details and address
        $guest = $guestOrders->isNotEmpty() ? optional($guestOrders->first()->guestOrder->guest) : null;
        $guestAddress = $guestOrders->isNotEmpty() ? optional($guestOrders->first()->guestOrder->guest) : null;
    
        // Pass $orderItems, $orderId, and user/guest details to the view
        return view('admin.order-details', compact('userOrders', 'guestOrders', 'user', 'address', 'guest', 'guestAddress', 'orderItems', 'orderId'));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    private function getOrderItemsWithDetails($orderId)
    {
        return OrderItems::with([
            'product',
            'userOrder.userAddress',
            'userOrder.user',
            'guestOrder.guest',
            'guestOrder.items' // Make sure this corresponds to the relationship name in GuestOrder model
        ])
        ->where('order_id', $orderId)
        ->get();
    }
    


    public function search(Request $request)
{
    $userOrders = DB::table('user_orders')
        ->select('user_orders.*', 'users.username as user_username') // Adjust column names as needed
        ->leftJoin('users', 'users.id', '=', 'user_orders.user_id')
        ->orderBy('user_orders.created_at', 'desc');

    $guestOrders = DB::table('guest_orders')
        ->select('guest_orders.*')
        ->orderBy('guest_orders.created_at', 'desc');

    if ($request->has('order_id')) {
        $userOrders->where('user_orders.order_id', $request->input('order_id'));
        $guestOrders->where('guest_orders.order_id', $request->input('order_id'));
    }

    $userOrders = $userOrders->get();
    $guestOrders = $guestOrders->get();

    $allOrders = $userOrders->concat($guestOrders)->sortByDesc('created_at');

    // Use paginate for the combined orders
    $allOrders = $this->paginate($allOrders, 10, 'page_all_orders');

    return view('admin.orders-index', compact('allOrders'));
}



    
    
    
public function filterByDate(Request $request)
{
    $request->validate([
        'order_date' => 'nullable|date',
    ]);

    $filteredOrders = Order::query();

    if ($request->filled('order_date')) {
        $selectedDate = Carbon::parse($request->order_date)->format('Y-m-d');
        $filteredOrders = $filteredOrders->whereDate('created_at', '=', $selectedDate);
    }

    // Retrieve all orders when no date is provided
    $allOrders = Order::orderBy('created_at', 'desc')->get();

    return view('admin.orders-index', compact('filteredOrders', 'allOrders'));
}















    

    
    public function orderHistory()
    {
        $user = auth()->user();
    
        $userOrders = UserOrder::with(['items.product'])
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->paginate(10); // You can adjust the number of items per page here
        
        return view('user.order-history', compact('userOrders'));
    }




    // public function trackOrder(Request $request)
    // {
    //     $request->validate([
    //         'order_id' => 'exists:user_orders,order_id',
    //     ]);

    //     $order = UserOrder::where('order_id', $request->order_id)->first();

    //     return view('orders-track', compact('order'));
    // }





    public function trackOrder(Request $request)
{
    $request->validate([
        'order_id' => 'sometimes|required|string',
    ]);

    // Check if an order_id is provided
    if ($request->has('order_id')) {
        $order = UserOrder::where('order_id', $request->order_id)->first();

        if (!$order) {
            $order = GuestOrder::where('order_id', $request->order_id)->first();
        }

        if (!$order) {
            return back()->with('error', 'The selected order ID is invalid.');
        }

        return view('orders-track', compact('order'));
    }

    // If no order_id provided, return the initial track order page
    return view('orders-track');
}

   
    




  
}
