<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        return view('katalogbuku');
    }
}
