<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $query = Product::where('name', 'like', '%' . $search . '%');
        } else {
            $query = Product::query();
        }

        $products = $query->paginate(8);
        $products->appends(['search' => $search]);

        $kategoria = null;
        $podkategoria = null;

        return view('client.vyber_produktov', compact('kategoria', 'podkategoria', 'products','search'));
    }
}