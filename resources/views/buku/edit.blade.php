<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Edit Buku</h4>

            {{-- tampilkan error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- pesan sukses --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}">
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}">
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit) }}">
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok) }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('dataBuku') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</x-layoutAdmin>
