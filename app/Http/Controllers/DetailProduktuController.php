<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DetailProduktuController extends Controller
{
    public function index($id)
    {
        $product = Product::findOrFail($id);

        // Vracia view s detailom produktu
        return view('client.detail_produktu', compact('product'));
    }
}
