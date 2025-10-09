<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Data Peminjaman Buku</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peminjaman</h3>
                </div>
                <div class="card-body">
                    @if($peminjaman->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $key => $p)
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
                                    <span class="badge
                                        @if($p->status == 'dipinjam') badge-warning
                                        @elseif($p->status == 'dikembalikan') badge-success
                                        @else badge-danger @endif">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->status == 'dipinjam')
                                        <form action="{{ route('kembalikanBuku', $p->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin buku sudah dikembalikan?')">
                                                <i class="fas fa-check"></i> Kembalikan
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('deletePeminjaman', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data peminjaman?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada data peminjaman.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layoutAdmin>
