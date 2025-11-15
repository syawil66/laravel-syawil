<x-layoutadmin>
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pengembalian Buku</h1>
                </div>
                <div class="col-sm-6">
                    {{--<ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengembalian</li>
                    </ol>--}}
                </div>
            </div>
        </div></section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    {{-- Ini adalah "wadah" untuk tabel Anda --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Buku yang Dikembalikan</h3>

                        </div>
                        <div class="card-body">
                            @if($pengembalian->count() > 0)
                            {{-- Ini adalah tabelnya --}}
                            <table id="tabelPengembalian" class="table table-bordered table-striped">
                                {{-- Bagian Header Tabel --}}
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Peminjam</th>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali (Jatuh Tempo)</th>
                                        <th>Tanggal Dikembalikan</th>
                                        <th>Status</th>
                                        <th>Denda</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody>
                            @foreach($pengembalian as $key => $p)
                            @php
                                // Hitung keterlambatan untuk tampilan
                                $keterlambatan = 0;
                                $keterangan = 'Tepat waktu';

                                if ($p->tanggal_pengembalian && $p->tanggal_kembali) {
                                    $tanggalKembali = \Carbon\Carbon::parse($p->tanggal_kembali);
                                    $tanggalPengembalian = \Carbon\Carbon::parse($p->tanggal_pengembalian);

                                    // Jika dikembalikan SETELAH tanggal kembali = TERLAMBAT
                                    if ($tanggalPengembalian->gt($tanggalKembali)) {
                                        $keterlambatan = $tanggalPengembalian->diffInDays($tanggalKembali);
                                        $keterangan = 'Terlambat';
                                    }
                                    // Jika dikembalikan SEBELUM tanggal kembali = LEBIH CEPAT
                                    elseif ($tanggalPengembalian->lt($tanggalKembali)) {
                                        $keterlambatan = $tanggalKembali->diffInDays($tanggalPengembalian);
                                        $keterangan = 'Lebih cepat';
                                    }
                                    // Jika sama = TEPAT WAKTU
                                    else {
                                        $keterangan = 'Tepat waktu';
                                    }

                                    // PASTIKAN bilangan BULAT
                                    $keterlambatan = (int)$keterlambatan;
                                }
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $p->user->name ?? 'N/A' }}</td>
                                <td>{{ $p->buku->judul ?? 'N/A' }}</td>
                                <td>
                                    @if($p->tanggal_pinjam)
                                        {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($p->tanggal_kembali)
                                        {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($p->tanggal_pengembalian)
                                        {{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}
                                    @else
                                        <span class="text-muted">Belum dikembalikan</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge
                                        @if($p->status == 'dipinjam') badge-warning
                                        @elseif($p->status == 'dikembalikan') badge-success
                                        @elseif($p->status == 'terlambat') badge-danger
                                        @else badge-secondary @endif">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->denda > 0)
                                        <span class="text-danger">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-success">Tidak ada denda</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->tanggal_pengembalian && $p->tanggal_kembali)
                                        @if($keterangan == 'Terlambat')
                                            <small class="text-danger">{{ $keterangan }} {{ $keterlambatan }} hari</small>
                                        @elseif($keterangan == 'Lebih cepat')
                                            <small class="text-info">{{ $keterangan }} {{ $keterlambatan }} hari</small>
                                        @else
                                            <small class="text-success">{{ $keterangan }}</small>
                                        @endif
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada data pengembalian.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layoutadmin>
