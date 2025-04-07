<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistraciaController extends Controller
{
    public function index()
    {
        return view('client.registracia');
    }
}
