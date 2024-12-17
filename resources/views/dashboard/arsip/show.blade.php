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
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('kaiadmin/assets/img/profile.jp') }}g" alt="..."
                                        class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold"> {{ Auth::guard('pegawai')->user()->nama_pegawai
                                        }}</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('kaiadmin/assets/img/profile.jpg') }}"
                                                    alt="image profile" class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4>{{ Auth::guard('pegawai')->user()->nama_pegawai }}</h4>

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
                        <h3 class="fw-bold mb-3">Arsip</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Detail Data Arsip Surat</div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <!-- Kiri -->
                                        <div class="col-lg-12">
                                            <!-- NO Surat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="no_surat">No Surat :</label>
                                                <input type="text" id="no_surat" name="no_surat"
                                                    class="form-control @error('no_surat') is-invalid @enderror"
                                                    required autofocus
                                                    value="{{ old('no_surat', $arsip->suratmasuk->no_surat) }}" disabled />
                                            </div>

                                            <!-- TGL Surat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_surat">Tanggal Surat :</label>
                                                <input type="date" id="tgl_surat" name="tgl_surat"
                                                    class="form-control @error('tgl_surat') is-invalid @enderror"
                                                    value="{{ old('tgl_surat', $arsip->suratmasuk->tgl_surat) }}" disabled />
                                            </div>

                                            <!-- Tgl Diterima -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_diterima">Diterima Tanggal :</label>
                                                <input type="date" id="tgl_diterima" name="tgl_diterima"
                                                    class="form-control @error('tgl_diterima') is-invalid @enderror"
                                                    value="{{ old('tgl_diterima', $arsip->suratmasuk->tgl_diterima) }}"
                                                    disabled />
                                            </div>

                                            <!-- tujuan dispo -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tujuan_dispo">Tujuan Dispo :</label>
                                                @php
                                                $tujuanDispoArray = explode(', ', $arsip->suratmasuk->tujuan_dispo);
                                                @endphp
                                                <ul>
                                                    @foreach($tujuanDispoArray as $tujuan)
                                                    <li class="py-auto">{{ $tujuan }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <!-- Asal surat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="asal_surat">Asal Surat :</label>
                                                <input type="text" id="asal_surat" name="asal_surat"
                                                    class="form-control @error('asal_surat') is-invalid @enderror"
                                                    value="{{ old('asal_surat', $arsip->suratmasuk->asal_surat) }}" disabled />
                                            </div>

                                            <!-- Perihal -->
                                            <div class="mb-3">
                                                <label class="form-label" for="perihal">Perihal :</label>
                                                <fieldset disabled>
                                                    <textarea id="perihal" name="perihal"
                                                        class="form-control @error('perihal') is-invalid @enderror"
                                                        rows="3">{{ old('perihal', $arsip->suratmasuk->perihal) }}</textarea>
                                                </fieldset>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="lampiran">Lampiran :</label>
                                                @if($arsip->suratmasuk->lampiran)
                                                <div>
                                                    <strong>File yang diupload:</strong><br>
                                                    @if(in_array(strtolower(pathinfo($arsip->suratmasuk->lampiran,
                                                    PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset('storage/' . $arsip->suratmasuk->lampiran) }}"
                                                        alt="Lampiran" style="max-width: 200px; max-height: 200px;">
                                                    @else
                                                    <a href="{{ asset('storage/' . $arsip->suratmasuk->lampiran) }}"
                                                        target="_blank" class="btn btn-primary">Download Lampiran</a>
                                                    @endif
                                                </div>
                                                @else
                                                <p>No file uploaded</p>
                                                @endif
                                            </div>

                                        </div>
                                        <!-- End column -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- kanan --}}

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="card-title">Catatan Disposisi</div>
                                    <!-- Tombol untuk membuka modal dan menambahkan disposisi -->
                                    @if($arsip->disposisi->catatan->isEmpty() ||
                                    !$arsip->disposisi->catatan->contains('id_pegawai',
                                    auth()->user()->id_pegawai))

                                    <P class="ms-auto">Belum Ada Lembar Disposisi</P>

                                    @else
                                    <!-- Tombol untuk mendownload disposisi dalam bentuk PDF -->
                                    <a href="{{ route('disposisi.download', $arsip->disposisi->id_dispo) }}"
                                        class="btn btn-success btn-round ms-auto">
                                        <i class="fa fa-download"></i>
                                        Download Disposisi
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <!-- Left column -->
                                        <div class="col-lg-12">
                                            <!-- NO agenda -->
                                            <div class="mb-3">
                                                <label class="form-label" for="no_agenda">No agenda :</label>
                                                <input type="text" id="no_agenda" name="no_agenda"
                                                    class="form-control @error('no_agenda') is-invalid @enderror"
                                                    required autofocus
                                                    value="{{ old('no_agenda', $arsip->disposisi->no_agenda) }}"
                                                    disabled />
                                            </div>

                                            <!-- Sifat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="sifat">Sifat :</label>
                                                <input type="text" id="sifat" name="sifat"
                                                    class="form-control @error('sifat') is-invalid @enderror"
                                                    value="{{ old('sifat', $arsip->disposisi->sifat) }}" disabled />
                                            </div>
                                           
                                            <!-- keterangan -->
                                            <div class="mb-3">
                                                <label class="form-label" for="keterangan">keterangan :</label>
                                                <input type="text" id="keterangan" name="keterangan"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    value="{{ old('keterangan', $arsip->disposisi->keterangan) }}" disabled />
                                            </div>

                                            @if($arsip->disposisi->catatan->isEmpty())
                                            <p>Tidak ada catatan untuk disposisi ini.</p>
                                            @else

                                            @foreach($disposisi->catatan as $catatan)
                                            <div class="mb-3">
                                                <label class="form-label" for="catatan"><strong> {{
                                                        $catatan->pegawai->nama_pegawai }} :</strong></label>
                                                <input type="text" id="catatan" name="catatan"
                                                    class="form-control @error('catatan') is-invalid @enderror"
                                                    value=" {{ $catatan->catatan }}" disabled />
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <!-- End col -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</div>

@endsection

</html>