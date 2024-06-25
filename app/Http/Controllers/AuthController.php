<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auth.login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('admin.auth.register', [
            'title' => 'Register'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usersData =  $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:4',
        ]);

        $usersData["password"] = Hash::make($usersData["password"]);
        $usersData["is_admin"] = 1;

        User::create($usersData);

        return redirect('/admin/login');
    }

    /**
     * Display the specified resource.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->with("loginError", "Login failed.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
