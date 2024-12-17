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
                        <h3 class="fw-bold mb-3">Surat</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Detail Data Surat</div>
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
                                                    value="{{ old('no_surat', $suratmasuk->no_surat) }}" disabled />
                                            </div>

                                            <!-- TGL Surat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_surat">Tanggal Surat :</label>
                                                <input type="date" id="tgl_surat" name="tgl_surat"
                                                    class="form-control @error('tgl_surat') is-invalid @enderror"
                                                    value="{{ old('tgl_surat', $suratmasuk->tgl_surat) }}" disabled />
                                            </div>

                                            <!-- Tgl Diterima -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_diterima">Diterima Tanggal :</label>
                                                <input type="date" id="tgl_diterima" name="tgl_diterima"
                                                    class="form-control @error('tgl_diterima') is-invalid @enderror"
                                                    value="{{ old('tgl_diterima', $suratmasuk->tgl_diterima) }}"
                                                    disabled />
                                            </div>

                                            <!-- tujuan dispo -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tujuan_dispo">Tujuan Dispo :</label>
                                                @php
                                                $tujuanDispoArray = explode(', ', $suratmasuk->tujuan_dispo);
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
                                                    value="{{ old('asal_surat', $suratmasuk->asal_surat) }}" disabled />
                                            </div>

                                            <!-- Perihal -->
                                            <div class="mb-3">
                                                <label class="form-label" for="perihal">Perihal :</label>
                                                <fieldset disabled>
                                                    <textarea id="perihal" name="perihal"
                                                        class="form-control @error('perihal') is-invalid @enderror"
                                                        rows="3">{{ old('perihal', $suratmasuk->perihal) }}</textarea>
                                                </fieldset>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="lampiran">Lampiran :</label>
                                                @if($suratmasuk->lampiran)
                                                <div>
                                                    <strong>File yang diupload:</strong><br>
                                                    @if(in_array(strtolower(pathinfo($suratmasuk->lampiran,
                                                    PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset('storage/' . $suratmasuk->lampiran) }}"
                                                        alt="Lampiran" style="max-width: 200px; max-height: 200px;">
                                                    @else
                                                    <a href="{{ asset('storage/' . $suratmasuk->lampiran) }}"
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
                                    <div class="card-title">Disposisi</div>
                                    <!-- Tombol untuk membuka modal dan menambahkan disposisi -->
                                    @if($disposisi)
                                    @else
                                    
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#modal-add" data-id_sm="{{ $suratmasuk->id_sm }}">
                                        <i class="fa fa-plus"></i>
                                        Add Disposisi
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <!-- Left column -->
                                        <div class="col-lg-12">
                                            @if($disposisi)
                                             <!-- NO Surat -->
                                             <div class="mb-3">
                                                <label class="form-label" for="no_agenda">No Agenda :</label>
                                                <input type="text" id="no_agenda" name="no_agenda"
                                                    class="form-control @error('no_agenda') is-invalid @enderror"
                                                   
                                                    value="{{ $disposisi->no_agenda }}" disabled />
                                            </div>
                                            
                                            <!-- Sifat Surat -->
                                             <div class="mb-3">
                                                <label class="form-label" for="sifat">Sifat :</label>
                                                <input type="text" id="sifat" name="sifat"
                                                    class="form-control @error('sifat') is-invalid @enderror"
                                                    
                                                    value="{{ $disposisi->sifat }}" disabled />
                                            </div>
                                            
                                            <!-- Keterangan Surat -->
                                             <div class="mb-3">
                                                <label class="form-label" for="keterangan">Keterangan :</label>
                                                <input type="text" id="keterangan" name="keterangan"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    
                                                    value="{{ $disposisi->keterangan }}" disabled />
                                            </div>
                                            
                                            @else
                                            <p>Disposisi belum tersedia.</p> <!-- Pesan jika tidak ada disposisi -->
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


<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg d-flex justify-content-center">
        <div class="modal-content w-100">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">Tambah Data Surat Masuk</h5>
            </div>

            <div class="modal-body p-3">
                <form id="fdata" action="{{route('disposisi.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Hidden input untuk id_sm -->
                    <input type="hidden" name="id_sm" id="id_sm" value="">

                    <div class="row">
                        <!-- Left column -->
                        <div class="col-lg-12">
                            <!-- INPUT No Surat -->
                            <div class="mb-3">
                                <label class="form-label" for="no_agenda">No Agenda</label>
                                <input type="text" id="no_agenda" name="no_agenda"
                                    class="form-control @error('no_agenda') is-invalid @enderror"
                                    value="{{ old('no_agenda') }}" />
                                @error('no_agenda')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Keterangan -->
                            <div class="mb-3">
                                <label class="form-label" for="keterangan">Keterangan Surat</label>
                                <select id="keterangan" name="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih keterangan Surat</option>
                                    <option value="Tanggapan dan Saran" {{ old('keterangan')=='Tanggapan dan Saran'
                                        ? 'selected' : '' }}>
                                        Tanggapan dan Saran</option>
                                    <option value="Proses Lebih Lanjut" {{ old('keterangan')=='Proses Lebih Lanjut'
                                        ? 'selected' : '' }}>
                                        Proses Lebih Lanjut</option>
                                    <option value="Koordinasi/Konfirmasikan" {{
                                        old('keterangan')=='Koordinasi/Konfirmasikan' ? 'selected' : '' }}>
                                        Koordinasi/Konfirmasikan</option>
                                </select>
                                @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INPUT Sifat -->
                            <div class="mb-3">
                                <label class="form-label" for="sifat">Sifat Surat</label>
                                <select id="sifat" name="sifat"
                                    class="form-control @error('sifat') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Sifat Surat</option>
                                    <option value="Sangat Segera" {{ old('sifat')=='Sangat Segera' ? 'selected' : '' }}>
                                        Sangat Segera</option>
                                    <option value="Segera" {{ old('sifat')=='Segera' ? 'selected' : '' }}>
                                        Segera</option>
                                    <option value="Rahasia" {{ old('sifat')=='Rahasia' ? 'selected' : '' }}>
                                        Rahasia</option>
                                </select>
                                @error('sifat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            

                        </div>
                        <!-- End coloumn -->
                    </div>
                    <!-- End coloumn -->

                    <!-- Submit button -->
                    <div class="text-end py-4">
                        <button type="submit" class="btn btn-rounded btn-primary col-lg-4">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<script>
// Script untuk menangani event klik pada tombol dan mengisi input id_sm
document.addEventListener('DOMContentLoaded', function () {
    // Menangani event saat modal akan ditampilkan
    $('#modal-add').on('show.bs.modal', function (event) {
        // Ambil tombol yang memicu modal
        var button = $(event.relatedTarget);  
        var id_sm = button.data('id_sm');  // Ambil ID Surat Masuk dari data-id_sm

        // Isi input hidden #id_sm dengan id_sm yang diambil
        var modal = $(this);
        modal.find('#id_sm').val(id_sm);  // Mengisi input tersembunyi dengan id_sm
    });
});

</script>


@endsection

</html>