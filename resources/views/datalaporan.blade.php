<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Laporan Perpustakaan</h4>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <button class="btn btn-success" onclick="cetakLaporan()">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-filter"></i> Filter Laporan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('dataLaporan') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Data</label>
                                    <select name="jenis_data" class="form-control">
                                        <option value="peminjaman" {{ $jenisData == 'peminjaman' ? 'selected' : '' }}>Data Peminjaman</option>
                                        <option value="pengembalian" {{ $jenisData == 'pengembalian' ? 'selected' : '' }}>Data Pengembalian</option>
                                        <option value="buku" {{ $jenisData == 'buku' ? 'selected' : '' }}>Data Buku</option>
                                        <option value="anggota" {{ $jenisData == 'anggota' ? 'selected' : '' }}>Data Anggota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Tampilkan
                                        </button>
                                        <a href="{{ route('dataLaporan') }}" class="btn btn-secondary">
                                            <i class="fas fa-sync"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-list"></i> Data Laporan
                        <small class="text-muted ml-2">
                            Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                            | Jenis: {{ ucfirst($jenisData) }}
                        </small>
                    </h5>
                </div>
                <div class="card-body">
                    @if($jenisData == 'peminjaman' && $peminjaman->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
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
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $p->user->name ?? 'N/A' }}</td>
                                        <td class="text-left">{{ $p->buku->judul ?? 'N/A' }}</td>
                                        <td>{{ $tanggalPinjam->format('d M Y') }}</td>
                                        <td>{{ $batasKembali->format('d M Y') }}</td>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @elseif($jenisData == 'pengembalian' && $pengembalian->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
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
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $p->user->name ?? 'N/A' }}</td>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @elseif($jenisData == 'buku' && $buku->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
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
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $b->judul }}</td>
                                        <td class="text-left">{{ $b->penulis }}</td>
                                        <td class="text-left">{{ $b->penerbit }}</td>
                                        <td>{{ $b->tahun_terbit }}</td>
                                        <td>
                                            <span class="badge {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $b->stok }} buku
                                            </span>
                                        </td>
                                        <td>{{ $b->kategori ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @elseif($jenisData == 'anggota' && $anggota->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($anggota as $key => $a)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $a->name }}</td>
                                        <td class="text-left">{{ $a->email }}</td>
                                        <td>{{ $a->telepon ?? '-' }}</td>
                                        <td class="text-left">{{ $a->alamat ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $a->role == 'admin' ? 'badge-primary' : 'badge-success' }}">
                                                {{ ucfirst($a->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Tidak ada data laporan untuk jenis yang dipilih.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        function cetakLaporan() {
            Swal.fire({
                title: 'Cetak Laporan?',
                text: "Laporan akan dicetak dalam format PDF",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Cetak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const startDate = '{{ $startDate }}';
                    const endDate = '{{ $endDate }}';
                    const jenisData = '{{ $jenisData }}';
                    const url = `{{ route('cetakLaporan') }}?start_date=${startDate}&end_date=${endDate}&jenis_data=${jenisData}`;

                    window.open(url, '_blank');
                }
            });
        }
    </script>
</x-layoutAdmin>
