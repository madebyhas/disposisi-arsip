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
                        <h3 class="fw-bold mb-3">Pegawai</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Data Surat Masuk</h4>
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#modal-add">
                                        <i class="fa fa-plus"></i>
                                        Add Surat Masuk
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Surat</th>
                                                <th>Tanggal</th>
                                                <th>Asal</th>
                                                <th>Perihal</th>
                                                <th>Tujuan</th>
                                                <th>Pegawai</th>
                                                <th colspan="2" class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($suratmasuk as $key => $value)
                                            <tr>
                                                <td>{{ $key += 1 }}</td>
                                                <td>{{ $value->no_surat }}</td>
                                                <td>{{ date('d-M-Y', strtotime($value->tgl_surat)) }}</td>

                                                <td>{{ $value->asal_surat }}</td>
                                                <td>{{ $value->perihal }}</td>
                                                <td>{{ $value->tujuan_dispo }}</td>
                                                <td>{{ $value->pegawai->nama_pegawai }}</td>
                                                <td colspan="2">
                                                    <div class="form-button-action mr-2">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('suratmasuk.edit', $value->id_sm) }}"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="tooltip" title="Edit Surat">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- Show Button -->
                                                        <a href="{{route('suratmasuk.show', $value->id_sm) }}"
                                                            class="btn btn-link btn-warning btn-lg"
                                                            data-bs-toggle="tooltip" title="Detail Surat & Disposisi">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('suratmasuk.destroy', $value->id_sm) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger btn-lg"
                                                                data-bs-toggle="tooltip" title="Delete">
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

<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg d-flex justify-content-center">
        <div class="modal-content w-100">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">Tambah Data Surat Masuk</h5>
            </div>

            <div class="modal-body p-3">
                <form id="fdata" action="{{route('suratmasuk.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-lg-6">
                            <!-- INPUT No Surat -->
                            <div class="mb-3">
                                <label class="form-label" for="no_surat">No Surat</label>
                                <input type="text" id="no_surat" name="no_surat"
                                    class="form-control @error('no_surat') is-invalid @enderror"
                                    value="{{ old('no_surat') }}" />
                                @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Tanggal Surat -->
                            <div class="mb-3">
                                <label class="form-label" for="tgl_surat">Tanggal Surat</label>
                                <input type="date" id="tgl_surat" name="tgl_surat"
                                    class="form-control @error('tgl_surat') is-invalid @enderror"
                                    value="{{ old('tgl_surat') }}" />
                                @error('tgl_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Tujuan -->
                            <div class="mb-3">
                                <label class="form-label">Tujuan Disposisi</label><br>

                                <div class="form-check">
                                    <input type="checkbox" id="direktur_teknik" name="tujuan_dispo[]"
                                        value="Direktur Teknik"
                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror" {{
                                        in_array('Direktur Teknik', old('tujuan_dispo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="direktur_teknik">
                                        Direktur Teknik
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="kebag_spi" name="tujuan_dispo[]" value="Kabag Umum"
                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror" {{
                                        in_array('Kepala SPI', old('tujuan_dispo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kebag_spi">
                                        Kepala SPI
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="kebag_umum" name="tujuan_dispo[]" value="Kabag Umum"
                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror" {{
                                        in_array('Kabag Umum', old('tujuan_dispo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kebag_umum">
                                        Kabag Umum
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="kabag_prod_dan_distribusi" name="tujuan_dispo[]"
                                        value="Kabag Prod dan Dist"
                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror" {{
                                        in_array('Kabag Prod dan Dist', old('tujuan_dispo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kabag_prod_dan_distribusi">
                                        Kabag Prod & Dist
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="kabag_hublang" name="tujuan_dispo[]"
                                        value="Kabag Hublang"
                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror" {{
                                        in_array('Kabag Hublang', old('tujuan_dispo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kabag_hublang">
                                        Kabag Hublang
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" id="kabag_keuangan" name="tujuan_dispo[]"
                                        value="Kabag Keuangan"
                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror" {{
                                        in_array('Kabag Keuangan', old('tujuan_dispo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kabag_keuangan">
                                        Kabag Keuangan
                                    </label>
                                </div>

                                @error('tujuan_dispo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <!-- End coloumn -->

                        <!-- Right column -->
                        <div class="col-lg-6">
                            <!-- INPUT Tanggal Diterima -->
                            <div class="mb-3">
                                <label class="form-label" for="tgl_diterima">Diterima Tanggal</label>
                                <input type="date" id="tgl_diterima" name="tgl_diterima"
                                    class="form-control @error('tgl_diterima') is-invalid @enderror"
                                    value="{{ old('tgl_diterima') }}" />
                                @error('tgl_diterima')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Asal Surat -->
                            <div class="mb-3">
                                <label class="form-label" for="asal_surat">Asal Surat</label>
                                <input type="text" id="asal_surat" name="asal_surat"
                                    class="form-control @error('asal_surat') is-invalid @enderror"
                                    value="{{ old('asal_surat') }}" />
                                @error('asal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Perihal -->
                            <div class="mb-3">
                                <label class="form-label" for="perihal">Perihal</label>
                                <textarea id="perihal" name="perihal"
                                    class="form-control @error('perihal') is-invalid @enderror"
                                    rows="3">{{ old('perihal') }}</textarea>
                                @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Lampiran -->
                            <div class="mb-3">
                                <label class="form-label" for="lampiran">Upload Lampiran</label>
                                <!-- Input file untuk meng-upload lampiran -->
                                <input id="lampiran" type="file" name="lampiran" onchange="readURL(this);"
                                    class="form-control @error('lampiran') is-invalid @enderror"
                                    value="{{ old('lampiran') }}" />

                                @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- End coloumn -->

                    <!-- Submit button -->
                    <div class="text-end py-3">
                        <button type="submit" class="btn btn-rounded btn-primary col-lg-4">Save</button>
                    </div>
                </form>

            </div>
        </div>
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
            { "data": "no_surat" },
            { "data": "tgl_surat" },
            { "data": "asal_surat" },
            { "data": "tujuan_dispo" },
            { "data": "perihal" },
            { "data": "pegawai" },
            { "data": "action" }
        ]
    });
});
</script>


</html>