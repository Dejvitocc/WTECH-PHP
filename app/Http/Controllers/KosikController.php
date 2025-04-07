<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KosikController extends Controller
{
    public function index()
    {
        return view('client.kosik');
    }
}
