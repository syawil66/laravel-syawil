<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // Method untuk user meminjam buku
    public function pinjamBuku(Request $request, $bukuId)
    {
        $buku = Buku::findOrFail($bukuId);
        $user = Auth::user();

        // Validasi
        if (!$buku->isAvailable()) {
            return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Cek apakah user sudah meminjam buku yang sama dan belum dikembalikan
        if ($user->isBorrowing($bukuId)) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini dan belum mengembalikannya.');
        }

        // Buat peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $bukuId,
            'tanggal_pinjam' => Carbon::now(),
            'tanggal_kembali' => Carbon::now()->addDays(7), // 7 hari batas peminjaman
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $buku->decreaseStock();

        return redirect()->back()->with('success', 'Buku berhasil dipinjam. Harap dikembalikan sebelum ' . $peminjaman->tanggal_kembali->format('d M Y'));
    }

    // Method untuk admin melihat data peminjaman
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('datapinjaman', compact('peminjaman'));
    }

    // Method untuk pengembalian buku
    public function kembalikanBuku($peminjamanId)
    {
        $peminjaman = Peminjaman::findOrFail($peminjamanId);

        // Update status dan tanggal pengembalian
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_pengembalian' => Carbon::now(),
        ]);

        // Tambah stok buku
        $peminjaman->buku->increaseStock();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // Method untuk menghapus data peminjaman
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Jika buku masih dipinjam, tambah stok kembali
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increaseStock();
        }

        $peminjaman->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function dataPengembalian()
    {
        $pengembalian = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dikembalikan')
            ->orderBy('tanggal_pengembalian', 'desc')
            ->get();

        return view('dataPengembalian', compact('pengembalian'));
    }

    // Method untuk riwayat peminjaman user
    public function riwayatPeminjaman()
    {
        $user = Auth::user();
        $riwayat = Peminjaman::with('buku')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayatPeminjaman', compact('riwayat'));
    }

    // Method untuk menghitung denda (opsional)
    public function hitungDenda($peminjamanId)
    {
        $peminjaman = Peminjaman::findOrFail($peminjamanId);

        if ($peminjaman->status === 'dipinjam' && Carbon::now()->gt($peminjaman->tanggal_kembali)) {
            $hariTerlambat = Carbon::now()->diffInDays($peminjaman->tanggal_kembali);
            $denda = $hariTerlambat * 5000; // Denda Rp 5.000 per hari

            $peminjaman->update([
                'status' => 'terlambat',
                'denda' => $denda
            ]);

            return $denda;
        }

        return 0;
    }
}
