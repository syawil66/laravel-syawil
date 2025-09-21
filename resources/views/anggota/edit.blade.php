<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Edit Anggota</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('updateAnggota', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $anggota->name) }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', $anggota->email) }}">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $anggota->alamat) }}">
                </div>

                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $anggota->no_telp) }}">
                </div>

                <div class="form-group">
                    <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('dataAnggota') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</x-layoutAdmin>
