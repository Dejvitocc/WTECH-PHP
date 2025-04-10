<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class VytvorenieObjednavkyController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::get();
        return view('client.vytvorenie_objednavky', compact('cartItems'));
    }
}
