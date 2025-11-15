<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman form edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    /**
     * Meng-update data profil.
     */
    public function update(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Siapkan data untuk di-update
        $data = $request->only('name', 'email', 'no_telp', 'alamat');

        // 3. Logika Upload Foto Profil
        if ($request->hasFile('foto_profil')) {

            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('profil', 'public');
            $data['foto_profil'] = $path;
        }

        // 4. Update data user
        $user->update($data);

        // 5. Kembalikan ke halaman profil dengan pesan sukses
        return redirect()->route('profile.edit')
                        ->with('success', 'Profil berhasil diperbarui!');
    }
}
