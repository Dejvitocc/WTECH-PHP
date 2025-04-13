<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCart;
use App\Models\DeliveryOption;
use App\Models\PaymentMethod;
use App\Models\Customer;

class VytvorenieObjednavkyController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::get();
        $deliveryOptions = DeliveryOption::get();
        $paymentMethods = PaymentMethod::get();

        // Získaj prihláseného používateľa, ak existuje
        $user = Auth::check() ? Customer::find(Auth::id()) : null;

        return view('client.vytvorenie_objednavky', compact('cartItems', 'deliveryOptions', 'paymentMethods', 'user'));
    }
}
