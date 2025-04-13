<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistraciaController extends Controller
{
    public function index()
    {
        return view('client.registracia');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'privacy_consent' => 'required|accepted',
        ]);

        Customer::create([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'password' => Hash::make($request->password),
            'privacy_consent' => true,
            'phone_number' => null,
            'street' => null,
            'home_number' => null,
            'postal_code' => null,
            'city' => null,
            'country' => null,
        ]);

        return redirect('/prihlasenie')->with('message', 'Registrácia úspešná! Prosím, prihláste sa.');
    }
}
