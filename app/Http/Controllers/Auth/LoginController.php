<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo =  '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//     public function redirectTo()
// {
//     if (Auth::user() && Auth::user()->role === 'admin') {
//         return route('products.index');
//     }

//     return $this->redirectTo;
// }



public function redirectTo()
{
    if (Auth::check()) {
        $role = Auth::user()->role;
        
        if ($role === 'manager') {
            return route('manager.dashboard');
        } elseif ($role === 'admin') {
            return route('admin.dashboard');
        } elseif ($role === 'salesperson') {
            return route('orders.index');
        }
    }

    return $this->redirectTo;
}




protected function attemptLogin(Request $request)
{
    $username = $request->input('email'); // Assuming the input field is named 'email'
    $password = $request->input('password');

    $credentials = filter_var($username, FILTER_VALIDATE_EMAIL)
        ? ['email' => $username, 'password' => $password]
        : ['username' => $username, 'password' => $password];

    return Auth::attempt($credentials, $request->filled('remember'));
}

// ...

protected function sendFailedLoginResponse(Request $request)
{
    throw ValidationException::withMessages([
        'email' => [trans('auth.failed')],
    ]);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}

