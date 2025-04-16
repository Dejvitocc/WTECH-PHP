<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlatobnaBranaController extends Controller
{
    public function index()
    {
        return view('client.platobna_brana');
    }

    public function processPayment(Request $request)
    {
        // Validácia údajov z formulára
        $validated = $request->validate([
            'card_number' => 'required|string|max:19',
            'expiration_month' => 'required|string|size:2',
            'expiration_year' => 'required|string|size:4',
            'cvv' => 'required|string|size:3',
        ]);

        $cardNumber = $validated['card_number'];
        $expirationMonth = $validated['expiration_month'];
        $expirationYear = $validated['expiration_year'];
        $cvv = $validated['cvv'];

        return redirect()->route('index')->with('success', 'Platba bola úspešne spracovaná!');
    }
}
