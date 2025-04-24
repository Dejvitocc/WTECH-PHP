<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\DeliveryOption;
use App\Models\Product;
use App\Models\ShoppingCart;

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

        // Retrieve order data from session
        $orderData = session('order_data');
        if (!$orderData) {
            return redirect()->route('vytvorenie_objednavky')->withErrors(['session' => 'Žiadne údaje o objednávke.']);
        }

        // Get or create customer
        $customer = null;
        $customerData = $orderData['customer'];
        if (Auth::check()) {
            $customer = Auth::user();
            // Update customer details
            $customer->update([
                'name' => $customerData['name'],
                'surname' => $customerData['surname'],
                'email' => $customerData['email'],
                'phone_number' => $customerData['phone_number'],
                'street' => $customerData['street'],
                'home_number' => $customerData['home_number'],
                'postal_code' => $customerData['postal_code'],
                'city' => $customerData['city'],
                'country' => $customerData['country'],
                'privacy_consent' => $customer->privacy_consent ?? true,
            ]);
        } else {
                // Neprihlásený používateľ
            $customer = null;
            
            // 1. Skúsime nájsť existujúceho zákazníka podľa emailu
            $customer = Customer::where('email', $customerData['email'])->first();
            
            if ($customer) {
                // Ak zákazník existuje, aktualizujeme údaje
                $customer->update([
                    'name' => $customerData['name'],
                    'surname' => $customerData['surname'],
                    'phone_number' => $customerData['phone_number'],
                    'street' => $customerData['street'],
                    'home_number' => $customerData['home_number'],
                    'postal_code' => $customerData['postal_code'],
                    'city' => $customerData['city'],
                    'country' => $customerData['country'],
                    'privacy_consent' => true,
                ]);
            } else {
                // Ak zákazník neexistuje, vytvoríme nový záznam
                $customer = Customer::create([
                    'email' => $customerData['email'],
                    'name' => $customerData['name'],
                    'surname' => $customerData['surname'],
                    'phone_number' => $customerData['phone_number'],
                    'street' => $customerData['street'],
                    'home_number' => $customerData['home_number'],
                    'postal_code' => $customerData['postal_code'],
                    'city' => $customerData['city'],
                    'country' => $customerData['country'],
                    'password' => '',
                    'privacy_consent' => true,
                ]);
            }
        }

        if (!$customer) {
            return redirect()->back()->withErrors(['customer' => 'Nepodarilo sa vytvoriť alebo nájsť zákazníka.']);
        }
        // Create order
        $order = Order::create([
            'customer_id' => $customer->id,
            'first_name' => $customerData['name'],
            'last_name' => $customerData['surname'],
            'email' => $customerData['email'],
            'phone' => $customerData['phone_number'],
            'address' => $customerData['street'] . ' ' . $customerData['home_number'],
            'city' => $customerData['city'],
            'postal_code' => $customerData['postal_code'],
            'payment_method' => $orderData['payment_method'],
            'total_price' => $orderData['total_amount'],
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($orderData['cart_items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'color' => $item['color'],
                'size' => $item['size'],
                'price' => $item['price'],
            ]);
        }

        //priradenie customer_id na vsetky polozky z anonymneho kosika
        ShoppingCart::whereNull('customer_id')->update(['customer_id' => $customer->id]);
        // Clear shopping cart
        ShoppingCart::where('customer_id', $customer->id)->delete();

        // Clear session data
        session()->forget(['order_data', 'coupon_code', 'coupon_discount', 'temp_customer_id']);

        return redirect()->route('index')->with('success', 'Platba bola úspešne spracovaná!');
    }
}
