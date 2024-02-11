<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Guest;
use App\Models\GuestOrder;

class GuestController extends Controller
{
    public function guest()
    {
        return view('guest.guest-checkout');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'house_number' => 'nullable|string|max:255', // Assuming house number is optional
            'pickup' => 'nullable|boolean',
        ]);

        

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone_number = $request->input('phone_number');
        $email = $request->input('email');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $street_address = $request->input('street_address');
        $house_number = $request->input('house_number');

            // Save the guest email in the session
           $request->session()->put('guest_email', $email);

        // Save the guest details in the guests table
        $guest = Guest::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'street_address' => $street_address,
            'house_number' => $house_number,
        ]);

        // Save the user address for the guest in the user_addresses table
        $userAddress = UserAddress::create([
            'guest_id' => $guest->id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'street_address' => $street_address,
            'house_number' => $house_number,
            'pickup' => $request->input('pickup', false),
        ]);

        // Continue with the rest of your code...
    }
}



   
   
   
   



