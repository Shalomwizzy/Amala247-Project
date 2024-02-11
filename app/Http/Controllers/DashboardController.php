<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        return view('user.dashboard', compact('user'));
    }

    public function accountDetails()
{
    $user = auth()->user(); // Assuming you're using Laravel's built-in authentication

    return view('user.account-details', compact('user'));
}

}
