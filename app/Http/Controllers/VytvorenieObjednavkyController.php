<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VytvorenieObjednavkyController extends Controller
{
    public function index()
    {
        return view('client.vytvorenie_objednavky');
    }
}
