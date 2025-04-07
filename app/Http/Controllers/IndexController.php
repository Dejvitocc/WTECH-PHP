<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index() {

        $popularProducts = Product::where('id', '>', 7)
            ->with('images')
            ->limit(6)
            ->get();

        $newProducts = Product::where('id', '>', 12)
            ->with('images')
            ->limit(6)
            ->get();

        return view('client.index', compact('popularProducts', 'newProducts'));
    }
}
