<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailProduktuController extends Controller
{
    public function index()
    {
        return view('client.detail_produktu');
    }
}
