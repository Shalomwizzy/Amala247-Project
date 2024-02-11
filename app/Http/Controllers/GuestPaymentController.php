<?php

namespace App\Http\Controllers;

use App\Mail\GuestOrderAdminNotify;
use App\Mail\GuestOrderReceived;
use App\Mail\NewOrderNotification;
use App\Models\Cart;
use App\Models\Guest;
use App\Models\GuestOrder;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class GuestPaymentController extends Controller
{
    public function placeOrder(Request $request)
    {
        $cartItems = Session::get('cart', []);
    
        if (empty($cartItems)) {
            return back()->with('error', 'Your cart is empty.');
        }
    
        // Generate a new order ID starting with "GU"
        $orderId = "GU" . rand(100000, 999999);
    
        $guestEmail = $request->input('email');
    
        if (!$guestEmail) {
            return back()->with('error', 'Guest email is missing.');
        }
    
        $guest = Guest::firstOrNew(['email' => $guestEmail]);
    
        if (!$guest->exists) {
            $guest->fill([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
                'country' => $request->input('country'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'street_address' => $request->input('street_address'),
                'house_number' => $request->input('house_number'),
            ])->save();
        }
    
        $orderItems = [];
        $totalAmount = 0;
    
        // Get the selected city during checkout
        $selectedCity = $request->input('city');
    
        // Retrieve the delivery fee based on the selected city
        $deliveryFee = $this->calculateDeliveryFee($selectedCity);
    
        // Add the global takeaway pack fee to the total amount
        $globalTakeawayPackFee = config('cart.takeaway_pack_fee', 0);
    
        // Calculate total amount for all items in the cart
        foreach ($cartItems as $key => $item) {
            // Calculate the product total based on quantity
            $productTotal = ($item['amount'] + $deliveryFee + $globalTakeawayPackFee) * $item['quantity'];
            $totalAmount += $productTotal;
    
            // Create and store order item
            $orderItem = GuestOrder::create([
                'order_id' => $orderId,
                'guest_id' => $guest->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'amount' => $item['amount'],
                'takeaway_pack' => $globalTakeawayPackFee,
                'delivery_fee' => $deliveryFee,
                'subtotal' => $item['amount'] * $item['quantity'],
                'total' => $productTotal, // Assign the correct total amount here
            ]);
    
            $orderItems[] = $orderItem;
    
            $this->storeOrderItem($orderItem, 'guest');
        }
    
        Session::put('orderItems', $orderItems);
    
        // Proceed to payment initialization
        $pay = json_decode($this->initialize_payment($totalAmount, $orderId));
    
        if ($pay) {
            if ($pay->status) {
                // Payment successful, proceed to payment
                return redirect($pay->data->authorization_url);
            } else {
                // Payment failed, return with error message
                return back()->with('error', $pay->message);
            }
        } else {
            // Payment initialization failed, return with error message
            return back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    
    
    
    

    




    
    protected function calculateDeliveryFee($city)
{
    // Fetch the delivery fees config
    $deliveryFees = config('cart.delivery_fees');

    // Fetch the delivery fee based on the selected city
    $deliveryFee = isset($deliveryFees[$city]) ? $deliveryFees[$city] : config('cart.default_delivery_fee', 0);

    return $deliveryFee;
}

    
    
    
    


    
    // ... (other methods)

    

    
    
protected function storeGuestOrderItem($orderItem)
{
    $this->storeOrderItem($orderItem, 'guest');
}





protected function storeOrderItem($orderItem, $orderType, $paystackRef = null, $paidAmount = null)
{
    $data = [
        'order_id' => $orderItem->order_id,
        'product_id' => $orderItem->product_id,
        'quantity' => $orderItem->quantity,
        'amount' => $orderItem->amount,
        'paystack_ref' => $paystackRef,
        'paid_amount' => $paidAmount,
        'order_status' => 'order placed',
        // Add other fields as needed
    ];

    // Set order type based on the condition
    if ($orderType === 'user') {
        $data['order_type'] = 'USER';
        $data['user_id'] = $orderItem->id;
        $data['guest_id'] = null;
    } elseif ($orderType === 'guest') {
        $data['order_type'] = 'GUEST';
        $data['user_id'] = null;
        $data['guest_id'] = $orderItem->id;
    }

    // Debugging: Dump and die to see the data
    // dd($data);

    OrderItems::create($data);
}




    
    
    
    


    

    public function handleCallback(Request $request, $ref)
    {
        $response = json_decode($this->verify_payment($request->reference));

        if ($response->status) {
          
            $data = $response->data;
            $amountPaid = ($data->amount / 100);

            if ($data->status != 'success') {
            
                GuestOrder::where('order_id', $ref)->delete();
                return redirect()->route('order.now')->with('error', $data->message);
            }

            $timestamp = strtotime($data->paid_at);
            $formattedDate = date('Y-m-d H:i:s', $timestamp);


            GuestOrder::where('order_id', $ref)->update([
                'order_status' => 'order placed',
                'paystack_ref' => $data->reference,
                'paystack_date' => $formattedDate,
                'paid_amount' => $amountPaid
            ]);

            $orderItems = GuestOrder::where('order_id', $ref)->get();

          
            $mail = new GuestOrderReceived($orderItems);
            Mail::to($orderItems[0]->guest->email)->send($mail);
           

           // Send new order notification to admin
           $adminEmail = 'support@example.com'; 
           Mail::to($adminEmail)->send(new  GuestOrderAdminNotify($orderItems));
        
            Session::forget('cart');

            return redirect()->route('order.now')->with('success', "Your Order has been placed");
        } else {
          
            return redirect()->route('order.now')->with('error', $response->message);
        }
    }




    public function initialize_payment($amount, $ref)
    {
        $url = "https://api.paystack.co/transaction/initialize";
    
        $amountSent = $amount * 100;
    
      
        $guestEmail = Session::get('guest_email', 'guest@example.com');
    
        $fields = [
            'email' => $guestEmail,
            'amount' => $amountSent,
            'callback_url' => route('guest-pay.callback', ['ref' => $ref]),
            // 'currency' => "USD"
        ];
    
        $fieldsString = http_build_query($fields);
    
        $ch = curl_init();
    
     
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    
        return $result;
    }

    
    
 
    
    
    






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
