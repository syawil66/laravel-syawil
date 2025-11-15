<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-warning { background-color: #ffc107; color: #000; }
        .badge-success { background-color: #28a745; color: #fff; }
        .badge-danger { background-color: #dc3545; color: #fff; }
        .badge-primary { background-color: #007bff; color: #fff; }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PERPUSTAKAAN</h2>
        <p>Sistem Manajemen Perpustakaan Digital</p>
    </div>

    <div class="info">
        <strong>Periode:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}<br>
        <strong>Jenis Data:</strong> {{ ucfirst($jenisData) }}<br>
        <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>

    @if($jenisData == 'peminjaman' && $peminjaman->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $key => $p)
                @php
                    $tanggalPinjam = \Carbon\Carbon::parse($p->tanggal_pinjam);
                    $batasKembali = \Carbon\Carbon::parse($p->tanggal_kembali);
                    $status = 'Dipinjam';
                    $warna = 'warning';
                @endphp
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $p->user->name ?? 'N/A' }}</td>
                    <td>{{ $p->buku->judul ?? 'N/A' }}</td>
                    <td class="text-center">{{ $tanggalPinjam->format('d M Y') }}</td>
                    <td class="text-center">{{ $batasKembali->format('d M Y') }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $warna }}">{{ $status }}</span>
                    </td>
                    <td class="text-center">
                        @if ($p->denda > 0)
                            Rp {{ number_format($p->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @elseif($jenisData == 'pengembalian' && $pengembalian->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengembalian as $key => $p)
                @php
                    $tanggalPinjam = \Carbon\Carbon::parse($p->tanggal_pinjam);
                    $batasKembali = \Carbon\Carbon::parse($p->tanggal_kembali);
                    $tanggalKembali = $p->tanggal_pengembalian ? \Carbon\Carbon::parse($p->tanggal_pengembalian) : null;
                    $status = 'Dikembalikan';
                    $warna = 'success';
                @endphp
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $p->user->name ?? 'N/A' }}</td>
                    <td>{{ $p->buku->judul ?? 'N/A' }}</td>
                    <td class="text-center">{{ $tanggalPinjam->format('d M Y') }}</td>
                    <td class="text-center">{{ $batasKembali->format('d M Y') }}</td>
                    <td class="text-center">
                        @if ($p->tanggal_pengembalian)
                            {{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge badge-{{ $warna }}">{{ $status }}</span>
                    </td>
                    <td class="text-center">
                        @if ($p->denda > 0)
                            Rp {{ number_format($p->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @elseif($jenisData == 'buku' && $buku->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $key => $b)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td>{{ $b->penerbit }}</td>
                    <td class="text-center">{{ $b->tahun_terbit }}</td>
                    <td class="text-center">{{ $b->stok }} buku</td>
                    <td>{{ $b->kategori ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @elseif($jenisData == 'anggota' && $anggota->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggota as $key => $a)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->email }}</td>
                    <td class="text-center">{{ $a->telepon ?? '-' }}</td>
                    <td>{{ $a->alamat ?? '-' }}</td>
                    <td class="text-center">{{ ucfirst($a->role) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p style="text-align: center; color: #666; font-style: italic;">
            Tidak ada data laporan untuk jenis yang dipilih.
        </p>
    @endif

    <div class="footer">
        Dicetak oleh: {{ Auth::user()->name }}<br>
        {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
