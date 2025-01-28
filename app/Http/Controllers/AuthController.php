<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View | RedirectResponse
    {

        if (Auth::check()) {
            return redirect()->route('application.dashboard');
        }

        return view('auth.login');
    }

    public function loginAction(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username' =>'required|max:255',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            return redirect()->intended(route('application.dashboard'));
        }

        return back()->withInput($request->only('username','remember'));
    }
}
