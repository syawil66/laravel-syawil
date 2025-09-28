<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Data Buku</h4>
           <a href="{{ route('createBuku') }}" class="btn btn-primary mb-3">

                <i class="fas fa-plus"></i> Tambah Buku
            </a>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Buku</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buku as $b)
                            <tr>
                                <td>{{ $b->judul }}</td>
                                <td>
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="Sampul {{ $b->judul }}" style="width: 100px; height: auto;">
                                    @else
                                        <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $b->penulis }}</td>
                                <td>{{ $b->penerbit }}</td>
                                <td>{{ $b->tahun_terbit }}</td>
                                <td>{{ $b->stok }}</td>
                                <td>
                                    <a href="{{ route('editBuku', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('deleteBuku', $b->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layoutAdmin>
