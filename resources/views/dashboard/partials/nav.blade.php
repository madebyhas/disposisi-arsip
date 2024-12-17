<!-- Sidebar -->
<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="navbar brand" class="navbar-brand" height="70" />
                <p id="subtitle" style="color: blue; text-emphasis-color: initial; margin: 0; padding-top: 10px; padding-right: 30px; display: block; text-align: center;">
                    <strong>PDAM TIRTA BENING</strong>
                </p>
            </div>
            
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        
        <!-- End Logo Header -->
    </div>
    <hr>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-section" style="padding-top: 10px;">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section text-dark">Homepage</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="collapsed"
                        aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Menampilkan menu untuk Pegawai Sekertaris Kasubag -->
                @if(in_array(Auth::guard('pegawai')->user()->hak_akses, ['Pegawai', 'Kepala SubBagian']))
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section text-dark">Surat</h4>
                </li>
                <!-- Surat Masuk -->
                <li class="nav-item">
                    <a href="{{ route('suratmasuk.index') }}">
                        <i class="fas fa-pen-square"></i>
                        <p>Surat Masuk</p>
                    </a>
                </li>
                
                @elseif(in_array(Auth::guard('pegawai')->user()->hak_akses, ['Kepala Bagian']))
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section text-dark">Surat</h4>
                </li>
                <!-- Surat Masuk -->
                <li class="nav-item">
                    <a href="{{ route('suratmasuk.index') }}">
                        <i class="fas fa-pen-square"></i>
                        <p>Surat Masuk</p>
                    </a>
                </li>
                <!-- Disposisi -->
                <li class="nav-item">
                    <a href="{{ route('disposisi.index') }}">
                        <i class="fa-solid fa-book"></i>
                        <p>Disposisi</p>
                    </a>
                </li>

                @elseif(in_array(Auth::guard('pegawai')->user()->hak_akses, ['Direktur', 'super']))
                <!-- Menampilkan menu untuk Direktur -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section text-dark">Surat</h4>
                </li>
                <!-- Surat Masuk -->
                <li class="nav-item">
                    <a href="{{ route('suratmasuk.index') }}">
                        <i class="fas fa-pen-square"></i>
                        <p>Surat Masuk</p>
                    </a>
                </li>
                <!-- Disposisi -->
                <li class="nav-item">
                    <a href="{{ route('disposisi.index') }}">
                        <i class="fa-solid fa-book"></i>
                        <p>Disposisi</p>
                    </a>
                </li>
                <!-- Arsip -->
                <li class="nav-item">
                    <a href="{{ route('arsip.index') }}">
                        <i class="fa-regular fa-folder-open"></i>
                        <p>Arsip</p>
                    </a>
                </li>
                <!-- Laporan -->
                {{-- <li class="nav-item">
                    <a href="../../documentation/index.html">
                        <i class="fas fa-file"></i>
                        <p>Laporan</p>
                        <span class="badge badge-secondary">1</span>
                    </a>
                </li> --}}
                <!-- User Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section text-dark">User</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tampil.pegawai') }}">
                        <i class="fa-solid fa-circle-user"></i>
                        <p>Add Pegawai</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->