<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ShoppingCartController extends Controller
{
    public function index()
    {
        // Načítanie položiek košíka pre aktuálne prihláseného zákazníka alebo anonymného používateľa
        $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->id() : null;
        $cartItems = ShoppingCart::where('customer_id', $customerId)
            ->with(['product.images']) // Načítať produkt aj jeho obrázky
            ->get();

        // Poslať položky do pohľadu
        return view('client.kosik', compact('cartItems'));
    }

    /**
     * Presmerovanie na vytvorenie objednávky
     */
    public function proceedToOrder()
    {
        // Načítanie položiek košíka pre aktuálne prihláseného zákazníka
        $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->id() : null;
        $cartItems = ShoppingCart::where('customer_id', $customerId)->get();

        // Kontrola, či je košík prázdny
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Nemôžete pokračovať s prázdnym košíkom.');
        }

        // Ak košík nie je prázdny, presmerovať na vytvorenie objednávky
        return redirect('/vytvorenie_objednavky');
    }

    /**
     * Pridať položku do košíka
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $color = $request->input('selected_color');
        $size = $request->input('selected_size');

        $product = Product::findOrFail($productId);

        $colors = is_array($product->color) ? $product->color : explode(',', $product->color);
        $sizes = is_array($product->size) ? $product->size : explode(',', $product->size);

        // Farba
        if (!$color) {
            if (count($colors) === 1) {
                $color = $colors[0];
            } else {
                return redirect()->back()->with('warning', 'Prosím, vyberte farbu produktu.')->withInput();
            }
        }

        // Veľkosť
        if (!$size) {
            if (count($sizes) === 1) {
                $size = $sizes[0];
            } else {
                return redirect()->back()->with('warning', 'Prosím, vyberte veľkosť produktu.')->withInput();
            }
        }

        // Použijeme customer_id prihláseného zákazníka, ak je prihlásený, inak null
        $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->id() : null;

        $cartItem = ShoppingCart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        if ($cartItem) {
            // Ak položka existuje, aktualizovať množstvo
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Vytvoriť nový záznam
            ShoppingCart::create([
                'customer_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'color' => $color,
                'size' => $size,
            ]);
        }

        return redirect()->back()->with('success', 'Produkt bol pridaný do košíka!');
    }

    /**
     * Odstrániť položku z košíka
     */
    public function remove($productId)
    {
        // Použijeme customer_id prihláseného zákazníka, ak je prihlásený, inak null
        $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->id() : null;

        $cartItem = ShoppingCart::where('id', $productId)
            ->where('customer_id', $customerId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Položka bola odstránená z košíka!');
        }

        return redirect()->back()->with('error', 'Položka nebola nájdená v košíku.');
    }

    /**
     * Aktualizovať množstvo položky v košíku
     */
    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Použijeme customer_id prihláseného zákazníka, ak je prihlásený, inak null
        $customerId = Auth::guard('customer')->check() ? Auth::guard('customer')->id() : null;

        $cartItem = ShoppingCart::where('id', $itemId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        $cartItem->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Množstvo bolo aktualizované');
    }

    /**
     * Prenos položiek z anonymného košíka po prihlásení
     */
    public function syncCartAfterLogin()
    {
        if (Auth::guard('customer')->check()) {
            // Načítať položky z anonymného košíka (customer_id = null)
            $anonymousItems = ShoppingCart::where('customer_id', null)->get();

            foreach ($anonymousItems as $item) {
                // Skontrolovať, či už položka existuje v košíku prihláseného zákazníka
                $existingItem = ShoppingCart::where('customer_id', Auth::guard('customer')->id())
                    ->where('product_id', $item->product_id)
                    ->where('color', $item->color)
                    ->where('size', $item->size)
                    ->first();

                if ($existingItem) {
                    // Ak položka už existuje, pripočítať množstvo
                    $existingItem->quantity += $item->quantity;
                    $existingItem->save();
                } else {
                    // Inak preniesť položku a priradiť customer_id
                    $item->customer_id = Auth::guard('customer')->id();
                    $item->save();
                }
            }

            // Odstrániť všetky položky s customer_id = null (už boli prenesené)
            ShoppingCart::where('customer_id', null)->delete();
        }
    }
}
