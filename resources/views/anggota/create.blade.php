<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Tambah Anggota</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('storeAnggota') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
                </div>

                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('dataAnggota') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</x-layoutAdmin>
