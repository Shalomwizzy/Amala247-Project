<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\CartGuestController;
use App\Models\Coupon;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
   
 // ...
 public function addToCart(Request $request)
 {
     $request->validate([
         'product_id' => 'required',
     ]);
 
     $productId = $request->input('product_id');
     $quantity = 1;
     $product = Products::find($productId);
 
     if (!$product) {
         return back()->with('error', 'Product not found');
     }
 
     // No delivery fee and takeaway pack for this calculation
     $amount = $product->product_price * intval($quantity);
     $subtotal = $product->product_price * $quantity;
 
     // Check if the user is authenticated
     if (auth()->check()) {
         $refNumb = "AM" . rand(100000, 999999);
 
         $cart = Cart::create([
             'order_id' => $refNumb,
             'user_id' => auth()->user()->id,
             'product_id' => $productId,
             'quantity' => $quantity,
             'takeaway_pack' => 0, // No takeaway pack fee
             'delivery_fee' => 0, // No delivery fee
             'subtotal' => $subtotal,
             'total' => $amount, // Only consider the product price in total
             'cart_status' => 'added',
             'amount' => $amount,
         ]);
 
         if ($cart) {
             return back()->with('success', 'Product added to cart successfully');
         } else {
             return back()->with('error', 'Failed to add to cart, please try again');
         }
     }
 
     // If not authenticated, redirect to the CartGuestController for handling non-authenticated users
     return app(CartGuestController::class)->addToCart($request);
 }









 // ...
 public function applyCoupon(Request $request)
 {
     $request->validate([
         'coupon-code' => 'required|string',
     ]);
 
     $couponCode = $request->input('coupon-code');
 
     // Check if the coupon code has been used before
     $couponUsed = UserOrder::where('coupon_code', $couponCode)->exists();
 
     if ($couponUsed) {
         return back()->with('error', 'Coupon code already used');
     }
 
     $userCart = $this->getUserCart();
     $subtotal = $this->calculateSubtotal($userCart);
 
     $coupon = Coupon::where('code', $couponCode)
         ->where('expiry_date', '>=', now()) // Check if the coupon is not expired
         ->first();
 
     if (!$coupon) {
         return back()->with('error', 'Invalid or expired coupon code');
     }
 
     $cartValue = $subtotal; // Modify this based on how you calculate the total cart value
 
     if ($cartValue < $coupon->cart_value) {
         $message = sprintf(
             'Your cart value must be ₦%s or more to use this coupon.',
             number_format($coupon->cart_value, 2)
         );
 
         return back()->with('error', $message);
     }
 
     $discount = $coupon->calculateDiscount($subtotal);
     Session::put('coupon_discount', $discount);
     Session::put('coupon_code', $couponCode);
     Session::put('coupon_amount', $discount); // Assuming coupon amount is the same as discount
 
     return back()->with('success', 'Coupon applied successfully');
 }

 public function clearCouponSession()
{
    Session::forget('coupon_discount');
    Session::forget('coupon_code');
    Session::forget('coupon_amount');
}

 
 
 
 
 




protected function getUserCart()
{
    if (Auth::check()) {
        return Cart::where('user_id', Auth::user()->id)
            ->where('cart_status', 'added')
            ->with('product')
            ->get();
    } else {
        return app(CartGuestController::class)->getUserCart();
    }
}





protected function calculateSubtotal($cartItems)
{
    $subtotal = 0;

    foreach ($cartItems as $item) {
        $subtotal += $item->product->product_price * $item->quantity;
    }

    return $subtotal;
}





 



 
  
 




 


public function showCart()
{
    $userCart = [];
    $subtotal = 0;
    $quantity = 0;
    $takeawayPack = config('cart.takeaway_pack_fee');
    $deliveryFee = 0;

    if (Auth::check()) {
        $user = Auth::user();
        $userAddress = $user->userAddress; // Assuming there's a relationship between User and Address models

        // Ensure user has an address
        if (!$userAddress) {
            return redirect()->route('user.address')->with('error', 'Please update your address before proceeding to checkout.');
        }

        $userCity = $userAddress->city;

        $userCart = Cart::where('user_id', $user->id)
            ->where('cart_status', 'added')
            ->with('product')
            ->get();

        foreach ($userCart as $item) {
            $subtotal += $item->product->product_price * $item->quantity;
            $quantity += $item->quantity;
        }

        // Fetch delivery fee based on user's city
        $deliveryFee = config('cart.delivery_fees.' . $userCity, 0);
    } else {
        return app(CartGuestController::class)->showCart();
    }

    $total = $subtotal + $takeawayPack + $deliveryFee;

    if (empty($userCart)) {
        return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
    }

    return view('cart.cart-show', [
        'userCart' => $userCart,
        'subtotal' => $subtotal,
        'deliveryFee' => $deliveryFee,
        'takeawayPack' => $takeawayPack,
        'total' => $total,
        'quantity' => $quantity,
    ]);
}







    







 public function updateQuantity(Request $request, $productId)
 {
     $request->validate([
         'quantity' => 'required|integer|min:1',
     ]);
 
     $quantity = $request->input('quantity');
     $userCart = [];
     $updated = false;
 
     if (Auth::check()) {
         $userCart = Cart::where('user_id', Auth::user()->id)
             ->where('cart_status', 'added')
             ->where('product_id', $productId)
             ->first();
 
         if ($userCart) {
             $userCart->quantity = $quantity;
 
             // Recalculate subtotal based on the updated quantity
             $userCart->subtotal = $userCart->product->product_price * $quantity;
 
             // Do not include delivery fee in the total calculation
             $userCart->total = $userCart->subtotal;
             $userCart->save();
             $updated = true;
         }
     } else {
         // If not authenticated, redirect to the CartGuestController for handling non-authenticated users
         return app(CartGuestController::class)->updateQuantity($request, $productId);
     }
 
     if ($updated) {
         return back()->with('success', 'Quantity updated successfully');
     } else {
         return back()->with('error', 'Failed to update quantity');
     }
 }
 
 

 

 






public function removeFromCart($productId)
{
    $removed = false;

    if (Auth::check()) {
        $userCart = Cart::where('user_id', Auth::user()->id)
            ->where('cart_status', 'added')
            ->where('product_id', $productId)
            ->first();

        if ($userCart) {
            $userCart->delete();
            $removed = true;
        }
    } else {
        // If not authenticated, redirect to the CartGuestController for handling non-authenticated users
        return app(CartGuestController::class)->removeFromCart($productId);
    }

    return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully');
}




public function wishlist()
{
    $wishlistItems = [];

    if (Auth::check()) {
        $user = Auth::user();
        $wishlistItems = Wishlist::where('user_id', $user->id)->with('product')->get();
    } else {
        // If not authenticated, redirect to the CartGuestController for handling non-authenticated users
        return app(CartGuestController::class)->wishlist();
    }

    return view('cart.wishlist-show', compact('wishlistItems'));
}



public function addToWishlist(Request $request, $productId)
{
    $product = Products::find($productId);

    if (!$product) {
        return back()->with('error', 'Product not found');
    }

    $userId = Auth::id();

    if ($userId) {
        $existingWishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if (!$existingWishlistItem) {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            $wishlistCount = Wishlist::where('user_id', $userId)->count();

            return back()->with('success', 'Product added to wishlist successfully');
        } else {
            return back()->with('error', 'Product is already in your wishlist');
        }
    } else {
        // If not authenticated, redirect to the CartGuestController for handling non-authenticated users
        return app(CartGuestController::class)->addToWishlist($request, $productId);
    }
}




public function removeFromWishlist($id)
{
    $wishlistItem = Wishlist::where('user_id', Auth::user()->id)
        ->where('product_id', $id)
        ->first();

    if ($wishlistItem) {
        $wishlistItem->delete();
        return back()->with('success', 'Product removed from wishlist successfully');
    } else {
        // If the item is not found in the authenticated user's wishlist,
        // attempt to remove it from the guest wishlist
        return app(CartGuestController::class)->removeFromWishlist($id)
            ->with('error', 'Product not found in your wishlist');
    }
}










public function removeCoupon()
{
    Session::forget('coupon_discount');
    return back()->with('success', 'Coupon removed successfully');
}

}

