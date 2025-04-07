<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlatobnaBranaController extends Controller
{
    public function index()
    {
        return view('client.platobna_brana');
    }
}
