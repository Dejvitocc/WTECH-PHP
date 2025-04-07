<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class VyberProduktovController extends Controller
{
    public function index(Request $request)
    {
        $kategoria = $request->query('kategoria');
        $podkategoria = $request->query('podkategoria');

        $category = Category::where('name', $kategoria)->firstOrFail();
        $query = $category->products();

        if ($podkategoria) {
            $query->wherePivot('subcategory_id', $podkategoria);
        }

        $products = $query->paginate(8);
        $products->appends(['kategoria' => $kategoria, 'podkategoria' => $podkategoria]);

        return view('client.vyber_produktov', compact('kategoria', 'podkategoria', 'products'));
    }
}

