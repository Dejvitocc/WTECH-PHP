<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZabudnuteHesloController extends Controller
{
    public function index()
    {
        return view('client.zabudnute_heslo');
    }
}
