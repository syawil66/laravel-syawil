<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                {{-- =================================================== --}}
                {{-- MENU BERSAMA (Bisa dilihat semua role) --}}
                {{-- =================================================== --}}
          <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
                {{-- =================================================== --}}
                {{-- AWAL BAGIAN KHUSUS ADMIN --}}
                {{-- =================================================== --}}
          @if (Auth::user()->role =='admin')
          <li class="nav-item">
            <a href="{{ route('dataBuku')}}" class="nav-link">
              <i class="fas fa-book-open"></i>
              <p>
                Data Buku
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('dataAnggota')}}" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
                Data Anggota
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('dataPeminjaman') }}" class="nav-link">
              <i class="fas fa-handshake"></i>
              <p>
                Data Pinjaman
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('dataPengembalian') }}" class="nav-link">
              <i class="fas fa-undo-alt"></i>
              <p>
                Data Pengembalian
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('dataLaporan') }}" class="nav-link">
              <i class="fas fa-file-invoice"></i>
              <p>
                Data Laporan
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          @endif
                {{-- =================================================== --}}
                {{-- AKHIR BAGIAN KHUSUS ADMIN --}}
                {{-- =================================================== --}}

                {{-- =================================================== --}}
                {{-- AWAL BAGIAN KHUSUS USER --}}
                {{-- =================================================== --}}
          @if (Auth::user()->role =='user')
          <li class="nav-item">
            <a href="{{ route('katalogBuku') }}" class="nav-link">
              <i class="fas fa-th-list"></i>
              <p>
                Katalog Buku
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('riwayatPeminjaman') }}" class="nav-link">
              <i class="fas fa-history"></i>
              <p>
                Riwayat Peminjaman
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          @endif
                {{-- =================================================== --}}
                {{-- AKHIR BAGIAN KHUSUS USER --}}
                {{-- =================================================== --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
