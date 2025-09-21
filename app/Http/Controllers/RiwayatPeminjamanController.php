<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    public function index()
    {
        return view('riwayatpeminjaman');
    }
}
