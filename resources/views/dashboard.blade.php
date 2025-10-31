<x-layoutadmin>
    @if (Auth::user()->role == 'admin')
        {{-- Dashboard untuk admin --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard Admin</h1>
                        <p>Selamat datang, Administrator!</p>
                    </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div></div></div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalAnggota }}</h3>
                                <p>Total Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalBuku }}</h3>
                                <p>Total Buku</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $bukuDipinjam }}</h3>
                                <p>Sedang Dipinjam</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $dikembalikanHariIni }}</h3>
                                <p>Dikembalikan Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer">Lihat detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    </div>
                </div></section>
        @else
        {{-- Dashboard anggota --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard Anggota</h1>
                        <p>Halo, {{ auth()->user()->name }}! Berikut ringkasan pinjamanmu.</p>
                    </div></div></div></div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $userBukuDipinjam }}</h3>
                                <p>Buku Dipinjam</p>
                            </div>
                            <div class="icon"><i class="fas fa-book-reader"></i></div>
                            <a href="{{ route('riwayatPeminjaman') }}" class="small-box-footer">Lihat detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $userPerluDikembalikan }}</h3>
                                <p>Perlu Dikembalikan</p>
                            </div>
                            <div class="icon"><i class="fas fa-clock"></i></div>
                            <a href="{{ route('riwayatPeminjaman') }}" class="small-box-footer">Lihat detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-layoutadmin>
