<x-layoutadmin>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Profil</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    {{-- Tampilkan pesan sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Tampilkan pesan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> Ada kesalahan saat mengisi form:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- PENTING: enctype untuk upload file --}}
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            {{-- Tampilkan foto profil saat ini --}}
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('dist/img/user-default.png') }}"
                                                alt="Foto profil"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>

                                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                        <p class="text-muted text-center">{{ ucfirst($user->role) }}</p>

                                        <div class="form-group mt-3">
                                            <label for="foto_profil">Ubah Foto Profil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="foto_profil" name="foto_profil">
                                                    <label class="custom-file-label" for="foto_profil">Pilih file...</label>
                                                </div>
                                            </div>
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Diri</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                value="{{ old('no_telp', $user->no_telp) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Script untuk menampilkan nama file di form upload --}}
    @push('scripts')
    <script>
        // Skrip sederhana untuk menampilkan nama file di input 'custom-file'
        document.addEventListener('DOMContentLoaded', function () {
            var fileInput = document.getElementById('foto_profil');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    var fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file...';
                    var nextSibling = e.target.nextElementSibling;
                    if (nextSibling) {
                        nextSibling.innerText = fileName;
                    }
                });
            }
        });
    </script>
    @endpush
</x-layoutadmin>
