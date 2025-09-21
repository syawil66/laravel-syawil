<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreAnggotaRequest;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(StoreAnggotaRequest $request)
    {
        User::create($request->validated());


        return redirect()->route('dataAnggota')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = User::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|unique:users,email,' . $id,
            'alamat'  => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);

        $anggota = User::findOrFail($id);
        $anggota->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'alamat'  => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('dataAnggota')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = User::findOrFail($id);
        $anggota->delete();

        return redirect()->route('dataAnggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
