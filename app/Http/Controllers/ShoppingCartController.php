<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::where('customer_id', null)
            ->with(['product.images']) // Načítať produkt aj jeho obrázky
            ->get();

        // Poslať položky do pohľadu
        return view('client.kosik', compact('cartItems'));
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

        $product = Product::findOrFail($request->input('product_id'));

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

        // Pre neprihlásených používateľov customer_id = null
        $cartItem = ShoppingCart::where('customer_id', null)
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
                'customer_id' => null,
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
        
        $cartItem = ShoppingCart::where('id', $productId);
                          
            
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Položka bola odstránená z košíka!');
        }
            
        return redirect()->back()->with('error', 'Položka nebola nájdená v košíku.');
        
        
    }

    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = ShoppingCart::where('id', $itemId)
                    ->where('customer_id', auth()->id())
                    ->firstOrFail();

        $cartItem->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Množstvo bolo aktualizované');
    }


}
