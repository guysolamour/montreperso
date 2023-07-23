<?php

namespace App\Http\Controllers\Guysolamour;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 422);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nom'    => ['required'],
            'prenoms'  => ['required'],
            'contact'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create($data);

        Auth::login($user);

        return $user;
    }

    public function dashboard()
    {
        // Auth::loginUsingId(5);
        return view('dashboard.index');
    }
}
