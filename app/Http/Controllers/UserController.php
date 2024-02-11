<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateAccount(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id); 
    
        $request->validate([
            'profile_picture' => 'image|mimes:jpg,jpeg,png,gif|max:5028',
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        $data = $request->except('password', 'password_confirmation');
    
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
    
        // Update the user's details
        $user->update($data);
        
        // Handle profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            $uploadedFile = $request->file('profile_picture');
            $fileName = 'profile_picture_' . time() . '.' . $uploadedFile->extension();
            $location = public_path('profile_pictures');
            $uploadedFile->move($location, $fileName);
            
            $user->profile_picture = 'profile_pictures/' . $fileName;
            $user->save();
        }
        return redirect()->route('dashboard')->with('success', 'Account details updated successfully!');
    
    }
    
    }

