<?php

namespace App\Http\Controllers\User;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->middleware('auth:web')->only('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            // Authentication passed...
            

            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['message' => 'The provided credentials do not match our records.'])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('home');
    }
}
