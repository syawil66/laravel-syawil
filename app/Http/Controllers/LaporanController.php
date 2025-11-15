<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $jenisData = $request->get('jenis_data', 'peminjaman');

        $peminjaman = collect();
        $pengembalian = collect();
        $buku = collect();
        $anggota = collect();

        if ($jenisData == 'peminjaman') {
            $peminjaman = Peminjaman::with(['user', 'buku'])
                ->where('status', 'dipinjam')
                ->whereBetween('tanggal_pinjam', [$startDate, $endDate])
                ->orderBy('tanggal_pinjam', 'desc')
                ->get();
        } elseif ($jenisData == 'pengembalian') {
            $pengembalian = Peminjaman::with(['user', 'buku'])
                ->where('status', 'dikembalikan')
                ->whereBetween('tanggal_pengembalian', [$startDate, $endDate])
                ->orderBy('tanggal_pengembalian', 'desc')
                ->get();
        } elseif ($jenisData == 'buku') {
            $buku = Buku::orderBy('judul', 'asc')->get();
        } elseif ($jenisData == 'anggota') {
            $anggota = User::where('role', 'user')->orderBy('name', 'asc')->get();
        }

        return view('datalaporan', compact(
            'peminjaman',
            'pengembalian',
            'buku',
            'anggota',
            'startDate',
            'endDate',
            'jenisData'
        ));
    }

    public function cetakLaporan(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $jenisData = $request->get('jenis_data', 'peminjaman');

        $peminjaman = collect();
        $pengembalian = collect();
        $buku = collect();
        $anggota = collect();

        if ($jenisData == 'peminjaman') {
            $peminjaman = Peminjaman::with(['user', 'buku'])
                ->where('status', 'dipinjam')
                ->whereBetween('tanggal_pinjam', [$startDate, $endDate])
                ->orderBy('tanggal_pinjam', 'desc')
                ->get();
        } elseif ($jenisData == 'pengembalian') {
            $pengembalian = Peminjaman::with(['user', 'buku'])
                ->where('status', 'dikembalikan')
                ->whereBetween('tanggal_pengembalian', [$startDate, $endDate])
                ->orderBy('tanggal_pengembalian', 'desc')
                ->get();
        } elseif ($jenisData == 'buku') {
            $buku = Buku::orderBy('judul', 'asc')->get();
        } elseif ($jenisData == 'anggota') {
            $anggota = User::where('role', 'user')->orderBy('name', 'asc')->get();
        }

        return view('cetaklaporan', compact(
            'peminjaman',
            'pengembalian',
            'buku',
            'anggota',
            'startDate',
            'endDate',
            'jenisData'
        ));
    }
}
