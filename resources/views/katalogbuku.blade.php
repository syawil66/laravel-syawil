<x-layoutAdmin>
    <section class="content-header">
        <div class="container-fluid">
            <h4>Katalog Buku</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Search Form -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('katalogBuku') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, atau penerbit..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @foreach($bukus as $b)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title">{{ $b->judul }}</h5>
                        </div>
                        <div class="card-body">
                            @if($b->gambar)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}"
                                        class="img-fluid" style="max-height: 200px; object-fit: cover;">
                                </div>
                            @else
                                <div class="text-center mb-3 text-muted">
                                    <i class="fas fa-book fa-5x"></i>
                                </div>
                            @endif
                            <p class="card-text">
                                <strong>Penulis:</strong> {{ $b->penulis }}<br>
                                <strong>Penerbit:</strong> {{ $b->penerbit }}<br>
                                <strong>Tahun Terbit:</strong> {{ $b->tahun_terbit }}<br>
                                <strong>Stok:</strong>
                                <span class="badge {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }}">
                                    {{ $b->stok }} buku
                                </span>
                            </p>
                        </div>
                        <div class="card-footer">
                            @if($b->stok > 0)
                                <form action="{{ route('pinjamBuku', $b->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Yakin ingin meminjam buku ini?')">
                                        <i class="fas fa-book"></i> Pinjam Buku
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="fas fa-times"></i> Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($bukus->hasPages())
            <div class="row mt-3">
                <div class="col-md-12">
                    {{ $bukus->links() }}
                </div>
            </div>
            @endif

            @if($bukus->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Tidak ada buku yang tersedia.
            </div>
            @endif
        </div>
    </section>
</x-layoutAdmin>

