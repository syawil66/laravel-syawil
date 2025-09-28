<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Tambah Buku</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('storeBuku') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="gambar">Gambar Sampul</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}">
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}">
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok') }}">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('dataBuku') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</x-layoutAdmin>

