<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShoppingCartController;

class PrihlasenieController extends Controller
{
    public function index()
    {
        return view('client.prihlasenie');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();

            // Prenos položiek z anonymného košíka
            $cartController = new ShoppingCartController();
            $cartController->syncCartAfterLogin();

            return redirect()->intended('/')->with('success', 'Úspešne prihlásený!');
        }

        return back()->withErrors([
            'email' => 'Zadané prihlasovacie údaje sú nesprávne.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Úspešne odhlásený!');
    }
}
