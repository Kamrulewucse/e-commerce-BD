<?php

namespace App\Http\Controllers\Admin;

use App\Enumeration\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login() {
        return view('admin.auth.login');
    }

    public function loginPost(Request $request) {

       $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $user = User::where('email',$request->email)
            ->orWhere('username',$request->email)
            ->where('status',1)
            ->where('role',Role::$ADMIN)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        Auth::login($user, $request->boolean('remember'));
        return redirect()->intended('admin/dashboard');

    }

    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
