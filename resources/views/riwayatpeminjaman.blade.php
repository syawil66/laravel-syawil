<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Riwayat Peminjaman Saya</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Buku yang Dipinjam</h3>
                </div>
                <div class="card-body">
                    @if ($riwayat->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                    {{--<th>Aksi</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayat as $key => $p)
                                    @php
                                        $tanggalPinjam = \Carbon\Carbon::parse($p->tanggal_pinjam);
                                        $batasKembali = \Carbon\Carbon::parse($p->tanggal_kembali);
                                        $tanggalKembali = $p->tanggal_pengembalian ? \Carbon\Carbon::parse($p->tanggal_pengembalian) : null;

                                        if ($p->status == 'dipinjam') {
                                            $status = 'Dipinjam';
                                            $warna = 'warning';
                                        } else {
                                            $status = 'Dikembalikan';
                                            $warna = 'success';
                                        }
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $p->buku->judul ?? 'N/A' }}</td>
                                        <td>{{ $tanggalPinjam->format('d M Y') }}</td>
                                        <td>{{ $batasKembali->format('d M Y') }}</td>
                                        <td>
                                            @if ($p->tanggal_pengembalian)
                                                {{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $warna }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($p->denda > 0)
                                                <span class="text-danger fw-bold">
                                                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="text-success">-</span>
                                            @endif
                                        </td>
                                        {{--<td>
                                            @if($p->status == 'dipinjam')
                                                <form action="{{ route('kembalikanBuku', $p->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin mengembalikan buku?')">
                                                        <i class="fas fa-undo"></i> Kembalikan
                                                    </button>
                                                </form>

                                                <form action="{{ route('deletePeminjaman', $p->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data peminjaman?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#detailModal{{ $p->id }}">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            @endif
                                        </td>--}}
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Peminjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6"><strong>Buku:</strong></div>
                                                        <div class="col-md-6">{{ $p->buku->judul ?? 'N/A' }}</div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Penulis:</strong></div>
                                                        <div class="col-md-6">{{ $p->buku->penulis ?? '-' }}</div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Penerbit:</strong></div>
                                                        <div class="col-md-6">{{ $p->buku->penerbit ?? '-' }}</div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Tanggal Pinjam:</strong></div>
                                                        <div class="col-md-6">{{ $tanggalPinjam->format('d M Y') }}</div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Batas Kembali:</strong></div>
                                                        <div class="col-md-6">{{ $batasKembali->format('d M Y') }}</div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Tanggal Kembali:</strong></div>
                                                        <div class="col-md-6">
                                                            @if ($p->tanggal_pengembalian)
                                                                {{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Status:</strong></div>
                                                        <div class="col-md-6">
                                                            <span class="badge badge-{{ $warna }}">{{ $status }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Denda:</strong></div>
                                                        <div class="col-md-6">
                                                            @if ($p->denda > 0)
                                                                <span class="text-danger fw-bold">
                                                                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                                                                </span>
                                                            @else
                                                                <span class="text-success">Tidak ada denda</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if ($p->keterangan)
                                                    <div class="row mt-2">
                                                        <div class="col-md-6"><strong>Keterangan:</strong></div>
                                                        <div class="col-md-6">{{ $p->keterangan }}</div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Belum ada riwayat peminjaman.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layoutAdmin>
