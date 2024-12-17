<!DOCTYPE html>
@extends('dashboard.partials.head')
@section('css')


<!--  Section Container-->
@section('container')
<div class="wrapper">
    <div class="main-panel">
        <div class="main-header">
            <!-- Nav Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                        <div class="header" data-background-color="white">
                            <div class="logo">
                                <h5 id="subtitle"
                                    style="text-emphasis-color: initial; margin: 0; padding-top: 10px; padding-right: 30px; display: block; text-align: center;">
                                    <strong>DISPOSISI SURAT</strong>
                                    </5>
                            </div>
                        </div>
                    </nav>
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('icon-user.jpg') }}" alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold" style="color: blue;"> {{
                                        Auth::guard('pegawai')->user()->nama_pegawai }}</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('icon-user.jpg') }}" alt="image profile"
                                                    class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4 style="color: blue;">{{ Auth::guard('pegawai')->user()->nama_pegawai
                                                    }}</h4>

                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-secondary btn-sm"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        Logout
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </li>

                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Nav Head -->
        </div>
        <!-- Content -->
        <div class="container">
            <div class="page-inner">
                <!--  Validasi -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <!--  End Validasi -->
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Dashboard</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-2 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title"> Selamat Datang, <strong style="color: blue;">{{
                                                Auth::guard('pegawai')->user()->nama_pegawai
                                                }}</strong>
                                        </h5>
                                        <p class="text-dark mb-4">Silahkan unggah surat Anda hari ini.
                                            Klik view surat dibawah ini untuk akses cepat.</p>

                                        <a href="{{ route('suratmasuk.index') }}" class="btn btn-sm btn-outline-primary"
                                            style="font-size: medium;">
                                            <strong>
                                                View Surat
                                                &raquo;
                                            </strong>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-1 text-center text-sm-left">
                                    <div class="card-body pb-0 px-5 px-md-12">
                                        <img src="{{ asset('land.jpg') }}" height="160" alt="man">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="d-flex align-items-center justify-content-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Alur Disposisi</h3>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge info">
                                    <i class="far fa-paper-plane"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><strong>PEGAWAI</strong></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                            Unggah file surat yang akan diajukan disposisi pada halaman surat.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="timeline-badge info">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><strong>PEGAWAI</strong></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                           Buka button detail surat & disposisi kemudian isikan detail disposisi.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-inverted">
                                <div class="timeline-badge success">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><strong>KABAG/DIREKTUR</strong></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                           Direktur atau Kabag membuka halaman Disposisi untuk melihat disposisi yang ditujukan.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge success">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><strong>KABAG/DIREKTUR</strong></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                           Direktur atau Kabag membuka halaman Disposisi untuk memberikan catatan.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="timeline-badge info">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><strong>PEGAWAI</strong></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                           Buka button detail surat & disposisi untuk mengunduh surat yang telah diisi oleh Direktur/Kabag.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge info">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title"><strong>PEGAWAI</strong></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                           Pastikan Catatan disposisi yang telah diajukan telah terisi oleh para Direktur/Kabag yang ditujukan.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex align-items-center justify-content-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Selesei</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
</div>
</div>
@endsection






</html>