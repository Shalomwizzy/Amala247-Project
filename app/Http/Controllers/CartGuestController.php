<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartGuestController extends Controller
{
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

        $amount = $product->product_price * intval($quantity);
        $subtotal = $product->product_price * $quantity;

        // Generate a random order ID for the guest user
        $orderId = "GU" . rand(100000, 999999);

        $cartItem = [
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'amount' => $amount,
            'takeaway_pack' => 0, // No takeaway pack fee for guest
            'delivery_fee' => 0, // No delivery fee for guest
            'subtotal' => $subtotal,
            'cart_status' => 'added',
            'total' => $amount,
        ];

        Session::push('cart', $cartItem);

        return back()->with('success', 'Product added to cart successfully');
    }
    
    
    

    


    public function showCart()
    {
        $userCart = [];
        $subtotal = 0;
        $quantity = 0;
    
        $cartItems = Session::get('cart', []);
    
        foreach ($cartItems as $item) {
            $product = Products::find($item['product_id']);
            if ($product) {
                // Include city information in the $item array
                $item['city'] = $product->city; // Adjust this line based on how city information is stored in your product model
    
                $userCart[] = (object)[
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'delivery_fee' => $this->calculateDeliveryFee($item['city']), // Calculate delivery fee based on city
                    'takeaway_pack' => config('cart.takeaway_pack_fee', 0),
                ];
    
                $subtotal += $product->product_price * $item['quantity'];
                $quantity += $item['quantity'];
            }
        }
    
        $total = $subtotal + config('cart.delivery_fee', 0) + (config('cart.takeaway_pack_fee', 0) * $quantity);
    
        if (empty($userCart)) {
            return redirect()->route('order.now')->with('success', 'Your cart is empty.');
        }
    
        return view('cart.guest-show', [
            'userCart' => $userCart,
            'subtotal' => $subtotal,
            'deliveryFee' => config('cart.delivery_fee', 0),
            'takeawayPackFee' => config('cart.takeaway_pack_fee', 0),
            'total' => $total,
            'quantity' => $quantity,
        ]);
    }
    


    private function calculateDeliveryFee($city) {
        // Retrieve delivery fees from config file
        $deliveryFees = config('cart.delivery_fees');
    
        // Check if the city exists in the delivery fees configuration
        if (array_key_exists($city, $deliveryFees)) {
            // If the city exists, return the corresponding delivery fee
            return $deliveryFees[$city];
        } else {
            // If the city is not found in the configuration, return a default value or handle it accordingly
            return config('cart.default_delivery_fee', 0);
        }
    }
    
    
    
    




    public function updateQuantity(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');
        $cartItems = Session::get('cart', []);
        $updated = false;

        foreach ($cartItems as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] = $quantity;
                $item['total'] = $item['amount'] * $quantity; // Recalculate total based on the updated quantity
                $updated = true;
                break;
            }
        }

        Session::put('cart', $cartItems);

        if ($updated) {
            return back()->with('success', 'Quantity updated successfully');
        } else {
            return back()->with('error', 'Failed to update quantity');
        }
    }

    // ... (other methods)



    // Other methods for guest users can be added here




    public function removeFromCart($productId)
{
    $cartItems = Session::get('cart', []);
    $removed = false;

    foreach ($cartItems as $key => $item) {
        if ($item['product_id'] == $productId) {
            unset($cartItems[$key]);
            $removed = true;
            break;
        }
    }

    Session::put('cart', $cartItems);

    if (empty($cartItems)) {
        return redirect()->route('order.now')->with('success', 'Product removed from cart successfully');
    }

    return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully');
}




public function wishlist()
{
    $wishlistItems = [];

    $sessionWishlist = session('wishlist', []);

    foreach ($sessionWishlist as $wishlistItem) {
        $product = Products::find($wishlistItem['product_id']);

        if ($product) {
            $wishlistItem['product'] = $product;
            $wishlistItems[] = $wishlistItem;
        }
    }

    return view('cart.guest-wishlist', compact('wishlistItems'));
}



   public function addToWishlist(Request $request, $productId)
   {
    $product = Products::find($productId);

    if (!$product) {
        return back()->with('error', 'Product not found');
    }

    $wishlistItems = Session::get('wishlist', []);

    $existingWishlistItem = collect($wishlistItems)->where('product_id', $productId)->first();

    if (!$existingWishlistItem) {
        $wishlistItems[] = ['product_id' => $productId];
        Session::put('wishlist', $wishlistItems);

        $wishlistCount = count($wishlistItems);

        return back()->with('success', 'Product added to wishlist successfully');
    } else {
        return back()->with('error', 'Product is already in your wishlist');
    }
}


  public function removeFromWishlist($id)
  {
    $wishlistItems = Session::get('wishlist', []);

    foreach ($wishlistItems as $key => $item) {
        if (isset($item['product_id']) && $item['product_id'] == $id) {
            unset($wishlistItems[$key]);
            Session::put('wishlist', $wishlistItems);
            return back()->with('success', 'Product removed from wishlist successfully');
        }
    }

    return back()->with('error', 'Product not found in your wishlist');
}



}


