<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrihlasenieController extends Controller
{
    public function index()
    {
        return view('client.prihlasenie');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Prihlásenie úspešné, presmeruj na domovskú stránku alebo inú stránku
            return redirect('/')->with('message', 'Prihlásenie úspešné!');
        }

        return redirect()->back()->withErrors(['email' => 'Nesprávny email alebo heslo.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('message', 'Boli ste odhlásení.');
    }
}
