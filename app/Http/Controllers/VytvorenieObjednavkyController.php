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
        $userID = Auth::id();
        $cartItems = ShoppingCart::where('customer_id', $userID)->get();
        $deliveryOptions = DeliveryOption::get();
        $paymentMethods = PaymentMethod::get();


        // Získaj prihláseného používateľa, ak existuje
        $user = Auth::check() ? Customer::find(Auth::id()) : null;

        return view('client.vytvorenie_objednavky', compact('cartItems', 'deliveryOptions', 'paymentMethods', 'user'));
    }

    public function validateOrder(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'home_number' => 'required|string|max:50',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|in:SK,CZ,AT,DE,PL,HU,FR,IT,ES,GB',
            'delivery_option' => 'required|string|max:255',
            'delivery_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);
        
        // Get cart items
        $cartItems = ShoppingCart::where('customer_id', Auth::id() ?? null)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors(['cart' => 'Košík je prázdny.']);
        }

        // Store validated data and cart items in session
        $orderData = [
            'customer' => [
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'street' => $validated['street'],
            'home_number' => $validated['home_number'],
            'postal_code' => $validated['postal_code'],
            'city' => $validated['city'],
            'country' => $validated['country'],
            ],
            'delivery_option' => $validated['delivery_option'],
            'delivery_price' => $validated['delivery_price'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $validated['total_amount'],
            'cart_items' => $cartItems->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'color' => $item->color,
                    'size' => $item->size,
                ];
            })->toArray(),
        ];

        // Store in session
        session(['order_data' => $orderData]);

        // Redirect to payment gateway
        return redirect()->route('platobna_brana');
    }
}
