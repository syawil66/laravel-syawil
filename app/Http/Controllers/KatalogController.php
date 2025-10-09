<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Simpan hasil query ke dalam variabel $bukus (plural)
        $bukus = Buku::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                             ->orWhere('penulis', 'like', "%{$search}%")
                             ->orWhere('penerbit', 'like', "%{$search}%");
            })
            ->where('stok', '>', 0)
            ->paginate(9);

        return view('katalogbuku', ['bukus' => $bukus]);
    }
}
