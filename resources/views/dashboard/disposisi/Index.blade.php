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
                    <h3 class="fw-bold mb-3">Disposisi</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Disposisi</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sifat</th>
                                            <th>No Agenda</th>
                                            <th>Keterangan</th>
                                            <th>No Surat</th>
                                            <th>Tujuan</th>
                                            <th colspan="2" class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($disposisi as $key => $value)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $value->sifat }}</td>
                                            <td>{{ $value->no_agenda }}</td>
                                            {{-- <td>{{ date('d-M-Y', strtotime($value->tgl_surat)) }}</td> --}}

                                            <td>{{ $value->keterangan }}</td>
                                            
                                            <td>{{ $value->suratmasuk->no_surat }}</td>
                                            <td>{{ $value->suratmasuk->tujuan_dispo }}</td>
                                            <td colspan="2">
                                                <div class="form-button-action mr-2">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('disposisi.edit', $value->id_dispo) }}"
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-bs-toggle="tooltip" title="Tambah Catatan">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <!-- Show Button -->
                                                    <a href="{{route('disposisi.show', $value->id_dispo) }}"
                                                        class="btn btn-link btn-warning btn-lg"
                                                        data-bs-toggle="tooltip" title="Detail Disposisi">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('disposisi.destroy', $value->id_dispo) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger btn-lg"
                                                            data-bs-toggle="tooltip" title="Hapus Dispo">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
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

<!-- Memuat jQuery terlebih dahulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Memuat DataTables CSS -->
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- Memuat DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
$("#basic-datatables").DataTable({
    "columns": [
        { "data": "no" },
        { "data": "sifat" },
        { "data": "no_agenda" },
        { "data": "keterangan" },
        { "data": "no_surat" },
        { "data": "tujuan_dispo" },
        { "data": "action" }
    ]
});
});
</script>


</html>