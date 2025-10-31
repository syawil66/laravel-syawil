<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengecek user yang login
use Carbon\Carbon; // Untuk manipulasi tanggal


class DashboardController extends Controller
{

    public function index()
    {
        // 4. Cek role user yang sedang login
        if (Auth::user()->role == 'admin') {

            // ==================================
            // LOGIKA UNTUK ADMIN
            // ==================================


            $totalAnggota = User::where('role', 'user')->count();
            $totalBuku = Buku::count();
            $bukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();
            $dikembalikanHariIni = Peminjaman::where('status', 'dikembalikan')
                                        ->whereDate('tanggal_kembali', Carbon::today())
                                        ->count();

            // 5. Kirim data ini ke view 'dashboard.blade.php'
            return view('dashboard', [
                'totalAnggota' => $totalAnggota,
                'totalBuku' => $totalBuku,
                'bukuDipinjam' => $bukuDipinjam,
                'dikembalikanHariIni' => $dikembalikanHariIni,
            ]);

        } else {

            // ==================================
            // LOGIKA UNTUK ANGGOTA
            // ==================================

            $userId = Auth::id();

            // Menghitung buku yang sedang dipinjam oleh user ini
            $userBukuDipinjam = Peminjaman::where('user_id', $userId)
                                        ->where('status', 'dipinjam')
                                        ->count();

            // Di gambar Anda, "Perlu Dikembalikan" jumlahnya sama dengan "Buku Dipinjam"
            $userPerluDikembalikan = $userBukuDipinjam;

            // 5. Kirim data ini ke view 'dashboard.blade.php'
            return view('dashboard', [
                'userBukuDipinjam' => $userBukuDipinjam,
                'userPerluDikembalikan' => $userPerluDikembalikan,
            ]);
        }
    }
}
