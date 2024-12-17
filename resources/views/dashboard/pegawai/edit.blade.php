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
                                <div class="card-title">Edit Data Pegawai</div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{route("pegawai.update",$pegawai->id_pegawai)}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <!-- Left column -->
                                        <div class="col-lg-6">
                                            <!-- INPUT PEGAWAI -->
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_pegawai">Nama Pegawai</label>
                                                <input type="text" id="nama_pegawai" name="nama_pegawai"
                                                    class="form-control @error('nama_pegawai') is-invalid @enderror" required autofocus
                                                    value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" />
                                                @error('nama_pegawai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- INPUT PEGAWAI -->
                                            <div class="mb-3">
                                                <label class="form-label" for="nip">NIP</label>
                                                <input type="text" id="nip" name="nip"
                                                    class="form-control @error('nip') is-invalid @enderror" required autofocus
                                                    value="{{ old('nip', $pegawai->nip) }}" />
                                                @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="telpon">NO Telp/WA</label>
                                                <input type="text" id="telpon" name="telpon"
                                                    class="form-control @error('telpon') is-invalid @enderror"
                                                    value="{{ old('telpon', $pegawai->telpon) }}" />
                                                @error('telpon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- INPUT JENIS KELAMIN -->
                                            <div class="mb-3">
                                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                                <select id="jenis_kelamin" name="jenis_kelamin"
                                                    class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                    required autofocus>
                                                    <option value="" disabled {{ empty($pegawai->jenis_kelamin) ?
                                                        'selected' : '' }}>Pilih
                                                        Jenis Kelamin</option>
                                                    <option value="laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) ==
                                                        'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) ==
                                                        'perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                                                    <option value="" disabled {{ empty($pegawai->jabatan) ?
                                                        'selected' : '' }}>Pilih
                                                        Jenis Kelamin</option>
                                                    <option value="Sub Bag Kas" {{ old('jabatan', $pegawai->jabatan) ==
                                                        'Sub Bag Kas' ? 'selected' : '' }}>
                                                        Sub Bag Kas</option>
                                                    <option value="Sub Bag Akuntansi" {{ old('jabatan', $pegawai->
                                                        jabatan) == 'Sub Bag Akuntansi' ? 'selected' : '' }}>
                                                        Sub Bag Akuntansi</option>
                                                    <option value="Sub Bag Anggaran" {{ old('jabatan', $pegawai->
                                                        jabatan) == 'Sub Bag Anggaran' ? 'selected' : '' }}>
                                                        Sub Bag Anggaran</option>
                                                    <option value="Sub Bag Sekretariat" {{ old('jabatan', $pegawai->
                                                        jabatan) == 'Sub Bag Sekretariat' ? 'selected' : '' }}>
                                                        Sub Bag Sekretariat</option>
                                                    <option value="Sub Bag Kepegawaian" {{ old('jabatan', $pegawai->
                                                        jabatan) == 'Sub Bag Kepegawaian' ? 'selected' : '' }}>
                                                        Sub Bag Kepegawaian</option>
                                                    <option value="Sub Bag Logistik" {{ old('jabatan', $pegawai->
                                                        jabatan) == 'Sub Bag Logistik' ? 'selected' : '' }}>
                                                        Sub Bag Logistik</option>
                                                    <option value="Sub Bag Perawatan Umum" {{ old('jabatan', $pegawai->
                                                        jabatan) == 'Sub Bag Perawatan Umum' ? 'selected' : '' }}>
                                                        Sub Bag Perawatan Umum</option>
                                                    <option value="Sub Bag Humas" {{ old('jabatan', $pegawai->jabatan)
                                                        == 'Sub Bag Humas' ? 'selected' : '' }}>
                                                        Sub Bag Humas</option>
                                                    <option value="Sub Bag Pengolahan Data Rekening" {{ old('jabatan',
                                                        $pegawai->jabatan) == 'Sub Bag Pengolahan Data Rekening' ?
                                                        'selected' : '' }}>
                                                        Sub Bag Pengolahan Data Rekening</option>
                                                    <option value="Sub Bag Perencanaan dan Evaluasi" {{ old('jabatan',
                                                        $pegawai->jabatan) == 'Sub Bag Perencanaan dan Evaluasi' ?
                                                        'selected' : '' }}>
                                                        Sub Bag Perencanaan dan Evaluasi</option>
                                                    <option value="Sub Bag Pengembangan dan Dokumentasi" {{
                                                        old('jabatan', $pegawai->jabatan) == 'Sub Bag Pengembangan dan
                                                        Dokumentasi' ? 'selected' : '' }}>
                                                        Sub Bag Pengembangan dan Dokumentasi</option>
                                                    <option value="Sub Bag Non Revenue Water" {{ old('jabatan',
                                                        $pegawai->jabatan) == 'Sub Bag Non Revenue Water' ? 'selected' :
                                                        '' }}>
                                                        Sub Bag Non Revenue Water</option>
                                                    <option value="Sub Bag Produksi dan Kualitas" {{ old('jabatan',
                                                        $pegawai->jabatan) == 'Sub Bag Produksi dan Kualitas' ?
                                                        'selected' : '' }}>
                                                        Sub Bag Produksi dan Kualitas</option>
                                                    <option value="Sub Bag Mekanikal dan Elektrikal" {{ old('jabatan',
                                                        $pegawai->jabatan) == 'Sub Bag Mekanikal dan Elektrikal' ?
                                                        'selected' : '' }}>
                                                        Sub Bag Mekanikal dan Elektrikal</option>
                                                    <option value="Sub Bag Distribusi dan Transmisi" {{ old('jabatan',
                                                        $pegawai->jabatan) == 'Sub Bag Distribusi dan Transmisi' ?
                                                        'selected' : '' }}>
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
                                                    <option value="Bagian Keuangan" {{ old('divisi', $pegawai->divisi)
                                                        == 'Bagian Keuangan' ? 'selected' : '' }}>
                                                        Bagian Keuangan</option>
                                                    <option value="Bagian Umum" {{ old('divisi', $pegawai->divisi) ==
                                                        'Bagian Umum' ? 'selected' : '' }}>
                                                        Bagian Umum</option>
                                                    <option value="Bagian Hubungan Langganan" {{ old('divisi',
                                                        $pegawai->divisi) == 'Bagian Hubungan Langganan' ? 'selected' :
                                                        '' }}>
                                                        Bagian Hubungan Langganan</option>
                                                    <option value="Bagian Perencanaan" {{ old('divisi', $pegawai->
                                                        divisi) == 'Bagian Perencanaan' ? 'selected' : '' }}>
                                                        Bagian Perencanaan</option>
                                                    <option value="Bagian Produksi dan Distribusi" {{ old('divisi',
                                                        $pegawai->divisi) == 'Bagian Produksi dan Distribusi' ?
                                                        'selected' : '' }}>
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
                                                    <option value="Kepala SubBagian" {{ old('hak_akses', $pegawai->
                                                        hak_akses) == 'Kepala SubBagian' ? 'selected' : '' }}>
                                                        Kepala SubBagian</option>
                                                    <option value="Kepala Bagian" {{ old('hak_akses', $pegawai->
                                                        hak_akses) == 'Kepala Bagian' ? 'selected' : '' }}>
                                                        Kepala Bagian</option>
                                                    <option value="Pegawai" {{ old('hak_akses', $pegawai->hak_akses) ==
                                                        'Pegawai' ? 'selected' : '' }}>
                                                        Pegawai</option>
                                                    <option value="Direktur" {{ old('hak_akses', $pegawai->hak_akses) ==
                                                        'Direktur' ? 'selected' : '' }}>
                                                        Direktur</option>
                                                    <option value="super" {{ old('hak_akses', $pegawai->hak_akses) ==
                                                        'super' ? 'selected' : '' }}>
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
                                                    value="{{ old('username', $pegawai->username) }}" />
                                                @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- INPUT PASS -->
                                            <div class="mb-3">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password'){{'is-invalid'}}@enderror"
                                                    value="{{$pegawai->password}}">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <!-- INPUT KONFIRM PASS -->
                                            <div class="mb-3">
                                                <label class="form-label" for="password_confirmation">Konfirmasi
                                                    Password</label>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    value="{{ old('password_confirmation') }}" />
                                                @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- End column -->

                                            <!-- INPUT ALAMAT COL FULL-->

                                            <div class="col-md-6 col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="alamat">Alamat</label>
                                                    <textarea id="alamat" name="alamat"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        rows="3">{{ old('alamat', $pegawai->alamat) }}</textarea>
                                                    @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <div class="text-end">
                                                <a href="{{ route('tampil.pegawai') }}" class="btn btn-rounded btn-warning col-lg-4">Cancel</a>
                                                <button type="submit"
                                                    class="btn btn-rounded btn-primary col-lg-4">Save</button>

                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
</div>

</html>