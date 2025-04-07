<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrihlasenieController extends Controller
{
    public function index()
    {
        return view('client.prihlasenie');
    }
}
