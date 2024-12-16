<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function RegisterForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email|max:30',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',
            ],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->save();

        if (auth()->user()->role_id == 1) {
            return redirect()->route('admin.dashboard')->with([
                'success' => true,
                'message' => 'User successfully registered by admin!',
            ]);
        }
        else{
            return redirect()->route('login')->with([
                'success' => true,
                'message' => 'Registration successful! Please log in to continue.',
            ]);
        }
    }

        public function checklogin(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();

                $token = $user->createToken('auth_token')->plainTextToken;
                $user->remember_token = $token;
                $user->save();

                if ($user->role_id == 2) {
                    return redirect()->route('user.dashboard')->with('message', 'Welcome to the User Panel')->with('token', $token);
                } else{
                    return redirect()->route('admin.dashboard')->with('message', 'Welcome to the Admin Panel')->with('token', $token);
                }

            } else {
                return redirect()->back()->withErrors(['message' => 'Failed to authenticate. Please check your credentials.']);
            }
        }

        public function logout(Request $request)
        {
            if ($request->user()) {
                $request->user()->tokens()->delete();
                $request->user()->remember_token = null;
                $request->user()->save();
                Auth::guard('web')->logout();
            }
            return redirect()->route('login')->with('success', 'You have been logged out successfully.');
        }
        public function userLogout(Request $request)
        {
            if ($request->user()) {
                $request->user()->tokens()->delete();
                $request->user()->remember_token = null;
                $request->user()->save();
                Auth::guard('web')->logout();
            }
            return redirect()->route('login')->with('success', 'You have been logged out successfully.');

        }
    
}
