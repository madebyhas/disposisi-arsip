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
                                    <h4 class="card-title">Data Pegawai</h4>
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#modal-add">
                                        <i class="fa fa-plus"></i>
                                        Add Pegawai
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table table-sm">
                                    <table id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pegawai</th>
                                                <th>NIP</th>
                                                <th>Jabatan</th>
                                                <th>Divisi</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider table-divider-color">
                                            @foreach($pegawai as $key => $value)
                                            <tr>
                                                <td>{{ $key += 1 }}</td>
                                                <td>{{ $value->nama_pegawai }}</td>
                                                <td>{{ $value->nip }}</td>
                                                <td>{{ $value->jabatan }}</td>
                                                <td>{{ $value->divisi }}</td>
                                                <td>{{ $value->username }}</td>
                                                <td>********</td>
                                                <td class="text-center" >
                                                    <div class="form-button-action mr-2">
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('pegawai.edit', $value->id_pegawai) }}"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="tooltip" title="Edit Pegawai">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form
                                                            action="{{ route('pegawai.destroy', $value->id_pegawai) }}"
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
                <h5 class="modal-title w-100">Tambah Data Pegawai</h5>
            </div>

            <div class="modal-body p-3">
                <form id="fdata" action="{{route('tambah.pegawai')}}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-lg-6">
                            <!-- INPUT PEGAWAI -->
                            <div class="mb-3">
                                <label class="form-label" for="nama_pegawai">Nama Pegawai</label>
                                <input type="text" id="nama_pegawai" name="nama_pegawai"
                                    class="form-control @error('nama_pegawai') is-invalid @enderror"
                                    value="{{ old('nama_pegawai') }}" />
                                @error('nama_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT PEGAWAI -->
                            <div class="mb-3">
                                <label class="form-label" for="nip">NIP</label>
                                <input type="text" id="nip" name="nip"
                                    class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" />
                                @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="telpon">NO Telp/WA</label>
                                <input type="text" id="telpon" name="telpon"
                                    class="form-control @error('telpon') is-invalid @enderror"
                                    value="{{ old('telpon') }}" />
                                @error('telpon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT JENIS KELAMIN -->
                            <div class="mb-3">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin')=='laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin')=='perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT JABATAN -->
                            <div class="mb-3">
                                <label class="form-label" for="jabatan">Jabatan</label>
                                <select id="jabatan" name="jabatan"
                                    class="form-control @error('jabatan') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    <option value="Sub Bag Kas" {{ old('jabatan')=='Sub Bag Kas' ? 'selected' : '' }}>
                                        Sub Bag Kas</option>
                                    <option value="Sub Bag Akuntansi" {{ old('jabatan')=='Sub Bag Akuntansi'
                                        ? 'selected' : '' }}>
                                        Sub Bag Akuntansi</option>
                                    <option value="Sub Bag Kas" {{ old('jabatan')=='Sub Bag Kas' ? 'selected' : '' }}>
                                        Sub Bag Anggaran</option>
                                    <option value="Sub Bag Anggaran" {{ old('jabatan')=='Sub Bag Anggaran' ? 'selected'
                                        : '' }}>
                                        Sub Bag Anggaran</option>
                                    <option value="Sub Bag Sekretariat" {{ old('jabatan')=='Sub Bag Sekretariat'
                                        ? 'selected' : '' }}>
                                        Sub Bag Sekretariat</option>
                                    <option value="Sub Bag Kepegawaian" {{ old('jabatan')=='Sub Bag Kepegawaian'
                                        ? 'selected' : '' }}>
                                        Sub Bag Kepegawaian</option>
                                    <option value="Sub Bag Logistik" {{ old('jabatan')=='Sub Bag Logistik' ? 'selected'
                                        : '' }}>
                                        Sub Bag Logistik</option>
                                    <option value="Sub Bag Perawatan Umum" {{ old('jabatan')=='Sub Bag Perawatan Umum'
                                        ? 'selected' : '' }}>
                                        Sub Bag Perawatan Umum</option>
                                    <option value="Sub Bag Humas" {{ old('jabatan')=='Sub Bag Humas' ? 'selected' : ''
                                        }}>
                                        Sub Bag Humas</option>
                                    <option value="Sub Bag Pengolahan Data Rekening" {{
                                        old('jabatan')=='Sub Bag Pengolahan Data Rekening' ? 'selected' : '' }}>
                                        Sub Bag Pengolahan Data Rekening</option>
                                    <option value="Sub Bag Perencanaan dan Evaluasi" {{
                                        old('jabatan')=='Sub Bag Perencanaan dan Evaluasi' ? 'selected' : '' }}>
                                        Sub Bag Perencanaan dan Evaluasi</option>
                                    <option value="Sub Bag Pengembangan dan Dokumentasi" {{
                                        old('jabatan')=='Sub Bag Pengembangan dan Dokumentasi' ? 'selected' : '' }}>
                                        Sub Bag Pengembangan dan Dokumentasi</option>
                                    <option value="Sub Bag Non Revenue Water" {{
                                        old('jabatan')=='Sub Bag Non Revenue Water' ? 'selected' : '' }}>
                                        Sub Bag Non Revenue Water</option>
                                    <option value="Sub Bag Produksi dan Kualitas" {{
                                        old('jabatan')=='Sub Bag Produksi dan Kualitas' ? 'selected' : '' }}>
                                        Sub Bag Produksi dan Kualitas</option>
                                    <option value="Sub Bag Mekanikal dan Elektrikal" {{
                                        old('jabatan')=='Sub Bag Mekanikal dan Elektrikal' ? 'selected' : '' }}>
                                        Sub Bag Mekanikal dan Elektrikal</option>
                                    <option value="Sub Bag Distribusi dan Transmisi" {{
                                        old('jabatan')=='Sub Bag Distribusi dan Transmisi' ? 'selected' : '' }}>
                                        Sub Bag Distribusi dan Transmisi</option>
                                </select>
                                @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <!-- End coloumn -->

                        <!-- Right column -->
                        <div class="col-lg-6">
                            <!-- INPUT DIVISI -->
                            <div class="mb-3">
                                <label class="form-label" for="divisi">Divisi</label>
                                <select id="divisi" name="divisi"
                                    class="form-control @error('divisi') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Divisi</option>
                                    <option value="Bagian Keuangan" {{ old('divisi')=='Bagian Keuangan' ? 'selected'
                                        : '' }}>
                                        Bagian Keuangan</option>
                                    <option value="Bagian Umum" {{ old('divisi')=='Bagian Umum' ? 'selected' : '' }}>
                                        Bagian Umum</option>
                                    <option value="Bagian Hubungan Langganan" {{
                                        old('divisi')=='Bagian Hubungan Langganan' ? 'selected' : '' }}>
                                        Bagian Hubungan Langganan</option>
                                    <option value="Bagian Perencanaan" {{ old('divisi')=='Bagian Perencanaan'
                                        ? 'selected' : '' }}>
                                        Bagian Perencanaan</option>
                                    <option value="Bagian Produksi dan Distribusi" {{
                                        old('divisi')=='Bagian Produksi dan Distribusi' ? 'selected' : '' }}>
                                        Bagian Produksi dan Distribusi</option>
                                </select>
                                @error('divisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT HAK AKSES -->
                            <div class="mb-3">
                                <label class="form-label" for="hak_akses">Hak Akses</label>
                                <select id="hak_akses" name="hak_akses"
                                    class="form-control @error('hak_akses') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Hak Akses</option>
                                    <option value="Kepala SubBagian" {{ old('divisi')=='Kepala SubBagian' ? 'selected'
                                        : '' }}>
                                        Kepala SubBagian</option>
                                    <option value="Kepala Bagian" {{ old('divisi')=='Kepala Bagian' ? 'selected' : ''
                                        }}>
                                        Kepala Bagian</option>
                                    <option value="Pegawai" {{ old('divisi')=='Pegawai' ? 'selected' : '' }}>
                                        Pegawai</option>
                                    <option value="Direktur" {{ old('divisi')=='Direktur' ? 'selected' : '' }}>
                                        Direktur</option>
                                    <option value="super" {{ old('divisi')=='super' ? 'selected' : '' }}>
                                        super</option>
                                </select>
                                @error('hak_akses')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT USERNAME -->
                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" id="username" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" />
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT PASS -->
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" />
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT KONFIRM PASS -->
                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    value="{{ old('password_confirmation') }}" />
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- End coloumn -->

                    <!-- INPUT ALAMAT COL FULL-->
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    rows="3">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="text-end">
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
            { "data": "nama_pegawai" },
            { "data": "nip" },
            { "data": "jabatan" },
            { "data": "divisi" },
            { "data": "username" },
            { "data": "password" },
            { "data": "action" }
        ]
    });
});

</script>


</html>