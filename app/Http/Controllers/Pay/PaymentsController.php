<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GuestPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserOrder;
use App\Models\Cart;
use App\Mail\OrderReceived;
use App\Mail\UserOrderAdminNotify;
use App\Models\CouponCode;
use App\Models\OrderItems;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    /**
     * Place an order.
     */
    public function place_order(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            if (empty($user->first_name) || empty($user->last_name) || empty($user->phone_number)) {
                return redirect()->route('account.details')->with('error', 'Please update your account details before proceeding to checkout.');
            }
    
            $userAddress = $user->userAddress;
    
            if (!$userAddress) {
                return redirect()->route('user.address')->with('error', 'Please update your address before proceeding to checkout.');
            }
    
            UserOrder::where('user_id', $user->id)->where('order_status', 'added')->delete();
    
            // Generate a new order ID starting with "AM"
            $orderId = 'AM' . rand(100000, 999999);
    
            // Calculate delivery fee and takeaway fee once for the entire order
            $city = $userAddress->city;
            $deliveryFee = config('cart.delivery_fees.' . $city, 0);
            $takeawayFee = config('cart.takeaway_pack_fee', 0);
    
            $orderItems = [];
            $totalAmount = 0; // Initialize total amount for all items
    
            // Get coupon code and coupon amount from session
            $couponCode = Session::get('coupon_code');
            $couponAmount = Session::get('coupon_amount');
    
            // Iterate over each item in the cart
            Cart::where('user_id', $user->id)->each(function ($item) use ($orderId, $user, $userAddress, &$orderItems, &$totalAmount, $couponCode, $couponAmount) {
                // Calculate the product total based on quantity
                $productTotal = $item->product->product_price * $item->quantity;
    
                // Add the total for this item to the overall total
                $totalAmount += $productTotal;

                $couponCode = Session::get('coupon_code');
                $couponAmount = Session::get('coupon_amount');
    
                // Create a new order item
                $orderItem = UserOrder::create([
                    'order_id' => $orderId,
                    'user_id' => $user->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'amount' => $item->product->product_price, // Use the product price
                    'subtotal' => $productTotal, // Use the calculated product total
                    'user_address_id' => $userAddress->id,
                    'coupon_code' => $couponCode, // Add the coupon code here
                    'coupon_amount' => $couponAmount, // Add the coupon amount here
                ]);
    
                // Add the order item to the array
                $orderItems[] = $orderItem;
            });
    
            // Calculate the total order amount (excluding delivery and takeaway fees)
            $totalOrderAmount = $totalAmount;
    
            // Check if a coupon discount is applied and subtract it from the total order amount
            $couponDiscount = Session::get('coupon_discount', 0);
            $totalOrderAmount -= $couponDiscount;
    
            // Calculate the total order amount (including delivery and takeaway fees)
            $totalOrderAmount += $deliveryFee + $takeawayFee;
    
            // Update each order item with the calculated delivery fee and takeaway fee
            foreach ($orderItems as $orderItem) {
                $orderItem->delivery_fee = $deliveryFee;
                $orderItem->takeaway_pack = $takeawayFee;
                $orderItem->total = $orderItem->subtotal + $deliveryFee + $takeawayFee;
                $orderItem->save();
            }
    
            $pay = json_decode($this->initialize_payment($totalOrderAmount, $orderId));
    
            if ($pay) {
                if ($pay->status) {
                    // Loop through each order item and save it to the orderitems table
                    foreach ($orderItems as $orderItem) {
                        $this->storeUserOrderItem($orderItem); // Assuming the user is authenticated
                    }
                    
                    // Redirect or perform any other action after successful payment
                    return redirect($pay->data->authorization_url);
                } else {
                    return back()->with('error', $pay->message);
                }
            } else {
                return back()->with('error', 'Something went wrong. Please try again!');
            }
        } else {
            // For guest users
            return app(GuestPaymentController::class)->placeOrder($request);
        }
    }
    
    
    
    
    
    
    
    
    
        


     

     
     
     
     





 

     protected function storeUserOrderItem($orderItem)
     {
         $this->storeOrderItem($orderItem, 'user');
     }
 
 


     protected function storeOrderItem($orderItem, $orderType, $paystackRef = null, $paidAmount = null)
     {
         $data = [
             'order_id' => $orderItem->order_id,
             'product_id' => $orderItem->product_id,
             'quantity' => $orderItem->quantity,
             'paystack_ref' => $paystackRef,
             'paid_amount' => $paidAmount,
             'amount' => $orderItem->amount,
             'order_status' => 'order placed',

             // Add other fields as needed
         ];
     
         // Set order type based on the condition
         if ($orderType === 'user') {
             $data['order_type'] = 'USER';
             $data['user_id'] = $orderItem->user_id;
             $data['guest_id'] = null;
         } elseif ($orderType === 'guest') {
             $data['order_type'] = 'GUEST';
             $data['user_id'] = null;
             $data['guest_id'] = $orderItem->guest_id;
         }
     
         OrderItems::create($data);
     }
     

    
    

    
    
    
    
     
     
     
     

     
     
     


    
    
    
    
    
    
    
    
    
    
    
    



    

    
    
    
    
    
    



        /**
     * Get the user's address based on the provided email.
     */
    public function getUserAddress($request)
    {
        $email = $request->input('email');

        if ($email) {
            $userAddress = UserAddress::where('email', $email)->first();

            if ($userAddress) {
                return $userAddress;
            }
        }

        return null;
    }


    /**
     * Handle payment callback.
     */
    public function handleCallback(Request $request, $ref)
    {
        if (Auth::check()) {
            // Handle callback for authenticated users
            $response = json_decode($this->verify_payment($request->reference));
    
            if ($response->status) {
                // Payment was successful
                $data = $response->data;
                $amountPaid = ($data->amount / 100);
    
                if ($data->status != 'success') {
                    // Handle the case where the payment is not successful for registered users
                    UserOrder::where('order_id', $ref)->delete();
                    return redirect()->route('cart.show')->with('error', $data->message);
                }
    
                $timestamp = strtotime($data->paid_at);
                $formattedDate = date('Y-m-d H:i:s', $timestamp);
    
                // Handle the case for registered users
                UserOrder::where('order_id', $ref)->update([
                    'order_status' => 'order placed',
                    'paystack_ref' => $data->reference,
                    'paystack_date' => $formattedDate,
                    'paid_amount' => $amountPaid
                ]);
    
                $orderItems = UserOrder::where('order_id', $ref)->get();
    
                // Send order received email to registered user with all order items
                $mail = new OrderReceived($orderItems);
                Mail::to($orderItems[0]->user->email)->send($mail);
    
                // Send new order notification to admin
                $adminEmail = 'support@example.com'; // Replace with the admin's email address
                Mail::to($adminEmail)->send(new UserOrderAdminNotify($orderItems));
    
                Cart::where('user_id', Auth::user()->id)->delete();
    
                // Clear coupon-related session variables
                Session::forget('coupon_code');
                Session::forget('coupon_amount');
                Session::forget('coupon_discount');
    
                return redirect()->route('cart.show')->with('success', "Your Order has been placed");
            } else {
                // Payment verification failed
                return back()->with('error', $response->message);
            }
        } else {
            // If not authenticated, reference GuestPaymentsController for non-registered users
            return app(GuestPaymentController::class)->handleGuestCallback($request, $ref);
        }
    }
    



    



        // THIS IS TO INITIALIZE PAYMENTS
        public function initialize_payment($amount, $ref)
        {
            $url = "https://api.paystack.co/transaction/initialize";
    
            $amountSent = $amount * 100;
            // dd($amountSent);
            $fields = [
                'email' => Auth::user()->email,
                'amount' => $amountSent,
                'callback_url' => route('pay.callback', ['ref' => $ref]),
                // 'currency' => "USD"
            ];
    
            $fields_string = http_build_query($fields);
    
            //open connection
            $ch = curl_init();
    
            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
                "Cache-Control: no-cache",
            ));
    
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
    
            return $result;
        }

    /**
     * Verify a payment with Paystack.
     */
    public function verify_payment($ref)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $ref,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        if ($response === false) {
            $error = curl_error($curl);
            return ['error' => $error];
        }

        curl_close($curl);

        return $response;
    }
}


