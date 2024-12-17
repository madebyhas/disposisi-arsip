<!DOCTYPE html>
@extends('dashboard.partials.head')
@section('css')


<!--  Section Container-->
@section('container')
{{-- wrapper --}}
<div class="wrapper">
    {{-- main penel --}}
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
                        <h3 class="fw-bold mb-3">Surat</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Data Surat</div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('suratmasuk.update', $suratmasuk->id_sm) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')

                                    <div class="row">
                                        <!-- Left column -->
                                        <div class="col-lg-6">
                                            <!-- INPUT PEGAWAI -->
                                            <div class="mb-3">
                                                <label class="form-label" for="no_surat">No Surat</label>
                                                <input type="text" id="no_surat" name="no_surat"
                                                    class="form-control @error('no_surat') is-invalid @enderror"
                                                    required autofocus
                                                    value="{{ old('no_surat', $suratmasuk->no_surat) }}" />
                                                @error('no_surat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <!-- INPUT PEGAWAI -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_diterima">
                                                    Tanggal surat</label>
                                                <input type="date" id="tgl_surat" name="tgl_surat"
                                                    class="form-control @error('tgl_surat') is-invalid @enderror"
                                                    value="{{ old('tgl_surat', $suratmasuk->tgl_surat) }}" />
                                                @error('tgl_surat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_diterima">Diterima
                                                    Tanggal</label>
                                                <input type="date" id="tgl_diterima" name="tgl_diterima"
                                                    class="form-control @error('tgl_diterima') is-invalid @enderror"
                                                    value="{{ old('tgl_diterima', $suratmasuk->tgl_diterima) }}" />
                                                @error('tgl_diterima')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- INPUT JENIS KELAMIN -->
                                            <div class="mb-3">
                                                <label class="form-label" for="asal_surat">Asal Surat</label>
                                                <input type="text" id="asal_surat" name="asal_surat"
                                                    class="form-control @error('asal_surat') is-invalid @enderror"
                                                    value="{{ old('asal_surat', $suratmasuk->asal_surat) }}" />
                                                @error('asal_surat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- INPUT JABATAN -->
                                            <div class="mb-3">
                                                <label class="form-label" for="perihal">Perihal</label>
                                                <textarea id="perihal" name="perihal"
                                                    class="form-control @error('perihal') is-invalid @enderror"
                                                    rows="3">{{ old('perihal', $suratmasuk->perihal) }}</textarea>
                                                @error('perihal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <!-- End coloumn -->

                                        <!-- Right column -->
                                        <div class="col-lg-6">
                                            <!-- INPUT DIVISI -->
                                            <div class="mb-3">
                                                @php
                                                // Pisahkan string tujuan_dispo yang dipisahkan dengan koma menjadi
                                                $tujuanDispoArray = explode(', ', $suratmasuk->tujuan_dispo);
                                                @endphp
                                                <label class="form-label">Tujuan Disposisi</label>
                                                <br>
                                                <!-- Direktur Teknik Checkbox -->
                                                <div class="form-check">
                                                    <input type="checkbox" id="direktur_teknik" name="tujuan_dispo[]"
                                                        value="Direktur Teknik"
                                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror"
                                                        {{ in_array('Direktur Teknik', $tujuanDispoArray) ? 'checked'
                                                        : '' }}>
                                                    <label class="form-check-label" for="direktur_teknik">Direktur
                                                        Teknik</label>
                                                </div>

                                                <!-- Kabag Hublang Checkbox -->
                                                <div class="form-check">
                                                    <input type="checkbox" id="kabag_hublang" name="tujuan_dispo[]"
                                                        value="Kabag Hublang"
                                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror"
                                                        {{ in_array('Kabag Hublang', $tujuanDispoArray) ? 'checked' : ''
                                                        }}>
                                                    <label class="form-check-label" for="kabag_hublang">Kabag
                                                        Hublang</label>
                                                </div>

                                                <!-- Kabag SPI Checkbox -->
                                                <div class="form-check">
                                                    <input type="checkbox" id="kabag_spi" name="tujuan_dispo[]"
                                                        value="Kabag SPI"
                                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror"
                                                        {{ in_array('Kabag SPI', $tujuanDispoArray) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="kabag_spi">Kabag
                                                        SPI</label>
                                                </div>

                                                <!-- Kepala Umum Checkbox -->
                                                <div class="form-check">
                                                    <input type="checkbox" id="kabag_umum" name="tujuan_dispo[]"
                                                        value="Kabag Umum"
                                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror"
                                                        {{ in_array('Kabag Umum', $tujuanDispoArray) ? 'checked' : ''
                                                        }}>
                                                    <label class="form-check-label" for="kabag_umum">Kabag
                                                        Umum</label>
                                                </div>

                                                <!-- Kabag Prod & Dist Checkbox -->
                                                <div class="form-check">
                                                    <input type="checkbox" id="kabag_prod_dan_distribusi"
                                                        name="tujuan_dispo[]" value="Kabag Prod dan Dist"
                                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror"
                                                        {{ in_array('Kabag Prod dan Dist', $tujuanDispoArray)
                                                        ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="kabag_prod_dan_distribusi">Kabag
                                                        Prod & Dist</label>
                                                </div>
                                                <!-- Kabag Keuangan Checkbox -->
                                                <div class="form-check">
                                                    <input type="checkbox" id="kabag_keuangan" name="tujuan_dispo[]"
                                                        value="Kabag Keuangan"
                                                        class="form-check-input @error('tujuan_dispo') is-invalid @enderror"
                                                        {{ in_array('Kabag Keuangan', $tujuanDispoArray) ? 'checked'
                                                        : '' }}>
                                                    <label class="form-check-label" for="kabag_keuangan">Kabag
                                                        Keuangan</label>
                                                </div>

                                                @error('tujuan_dispo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- INPUT HAK AKSES -->
                                            <div class="mb-3">
                                                <label class="form-label" for="lampiran">Upload Lampiran</label>
                                                <input id="lampiran" type="file" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror" />
                                            
                                                @if ($suratmasuk->lampiran)
                                                <!-- Jika ada lampiran, tampilkan link untuk mengunduh file -->
                                                <div class="mt-2">
                                                    <label>File yang sudah diunggah:</label>
                                                    <a href="{{ asset('storage/' . $suratmasuk->lampiran) }}" target="_blank">
                                                        {{ basename($suratmasuk->lampiran) }}  <!-- Menampilkan hanya nama file -->
                                                    </a>
                                                </div>
                                            @endif
                                            
                                            
                                                @error('lampiran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            

                                            <!-- End column -->

                                            <!-- Submit button -->
                                            <div class="text-end">
                                                <a href="{{ route('suratmasuk.index') }}" class="btn btn-rounded btn-warning col-lg-4">Cancel</a>
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