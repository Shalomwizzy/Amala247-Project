<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserAddress;

class UserAddressController extends Controller
{
  
    public function view()
    {
        $user = auth()->user();
        return view('user.address-view', compact('user'));
    }


    public function create()
    {
        $user = auth()->user();      
        return view('user.address-edit', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'street_address' => 'required',
            'house_number' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $userAddress = new UserAddress([
            'street_address' => $request->input('street_address'),
            'house_number' => $request->input('house_number'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
        ]);

        $user->userAddress()->save($userAddress);

        return redirect()->route('address.view')->with('success', ' Address updated successfully.');
    }

    public function edit()
    {
        $user = auth()->user();
        $userAddress = $user->shippingAddress;

        return view('user.address-edit', compact('user', 'userAddress'));
    }

    

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'street_address' => 'required',
            'house_number' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $user->userAddress()->updateOrCreate([], [
            'street_address' => $request->input('street_address'),
            'house_number' => $request->input('house_number'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
        ]);

       
        return redirect()->route('address.view')->with('success', 'Address updated successfully.');

    }        
}
