<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\DeliveryOption;
use App\Models\PaymentMethod;

class VytvorenieObjednavkyController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::get();
        $deliveryOptions = DeliveryOption::get();
        $paymentMethods = PaymentMethod::get();
        return view('client.vytvorenie_objednavky', compact('cartItems', 'deliveryOptions', 'paymentMethods'));
    }
}
