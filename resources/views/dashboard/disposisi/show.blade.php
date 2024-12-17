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
                        <h3 class="fw-bold mb-3">Disposisi</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Detail Data Disposisi</div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <!-- Kiri -->
                                        <div class="col-lg-12">
                                            <!-- NO surat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="no_surat">No surat :</label>
                                                <input type="text" id="no_surat" name="no_surat"
                                                    class="form-control @error('no_surat') is-invalid @enderror"
                                                    required autofocus
                                                    value="{{ old('no_surat', $disposisi->suratmasuk->no_surat) }}"
                                                    disabled />
                                            </div>

                                            <!-- tujuan dispo -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tujuan_dispo">Tujuan Dispo :</label>
                                                @php
                                                $tujuanDispoArray = explode(', ', $disposisi->suratmasuk->tujuan_dispo);
                                                @endphp
                                                <ul>
                                                    @foreach($tujuanDispoArray as $tujuan)
                                                    <li class="py-auto">{{ $tujuan }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <!-- NO agenda -->
                                            <div class="mb-3">
                                                <label class="form-label" for="no_agenda">No agenda :</label>
                                                <input type="text" id="no_agenda" name="no_agenda"
                                                    class="form-control @error('no_agenda') is-invalid @enderror"
                                                    required autofocus
                                                    value="{{ old('no_agenda', $disposisi->no_agenda) }}" disabled />
                                            </div>

                                            <!-- Sifat -->
                                            <div class="mb-3">
                                                <label class="form-label" for="sifat">Sifat :</label>
                                                <input type="text" id="sifat" name="sifat"
                                                    class="form-control @error('sifat') is-invalid @enderror"
                                                    value="{{ old('sifat', $disposisi->sifat) }}" disabled />
                                            </div>
                                            
                                            <!-- keterangan -->
                                            <div class="mb-3">
                                                <label class="form-label" for="keterangan">Keterangan :</label>
                                                <input type="text" id="keterangan" name="keterangan"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    value="{{ old('keterangan', $disposisi->keterangan) }}" disabled />
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
                                    @if($disposisi->catatan->isEmpty() || !$disposisi->catatan->contains('id_pegawai',
                                    auth()->user()->id_pegawai))
                                   
                                    <P class="ms-auto">Belum Ada Lembar Disposisi</P>
                                    
                                    @else
                                    <!-- Tombol untuk mendownload disposisi dalam bentuk PDF -->
                                    <a href="{{ route('disposisi.download', $disposisi->id_dispo) }}"
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

                                            @if($disposisi->catatan->isEmpty())
                                            <p>Tidak ada catatan untuk disposisi ini.</p>
                                            @else

                                            @foreach($disposisi->catatan as $catatan)
                                            <div class="mb-3">
                                                <label class="form-label" for="catatan"><strong> {{
                                                        $catatan->pegawai->nama_pegawai }} - {{
                                                            $catatan->pegawai->hak_akses }} :</strong></label>
                                                <input type="text" id="catatan" name="catatan"
                                                    class="form-control @error('catatan') is-invalid @enderror"
                                                    value=" {{ $catatan->catatan }}" disabled />
                                            </div>
                                            <!-- Tombol Edit Catatan -->
                                            {{-- <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit" data-id_dispo="{{ $disposisi->id_dispo }}"
                                                data-id_pegawai="{{ auth()->user()->id_pegawai }}"
                                                data-id="{{ $catatan->id }}" data-catatan="{{ $catatan->catatan }}">
                                                Edit Catatan
                                            </button> --}}
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



<!-- Modal Add  Catatan Disposisi -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-addLabel">Tambah Catatan Disposisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan disposisi -->
                <form id="form-disposisi" action="{{route('catatan-disposisi.store')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Input untuk id_dispo -->
                    <input type="hidden" id="id_dispo" name="id_dispo">
                    <!-- Input untuk id_pegawai -->
                    <input type="hidden" id="id_pegawai" name="id_pegawai">
                    <!-- Catatan -->
                    <div class="mb-5">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea id="catatan" name="catatan"
                            class="form-control  @error('catatan') is-invalid @enderror" rows="4" cols="50"
                            rows="3">{{ old('catatan')}}</textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary ">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<!-- Modal Edit Catatan -->
@if($disposisi->catatan->isEmpty())
<p>Tidak ada catatan untuk disposisi ini.</p>
@else
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-editLabel">Edit Catatan Disposisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit catatan -->
                <form action="{{ route('catatan-disposisi.update', $catatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input untuk id_dispo -->
                    <input type="hidden" id="id_dispo" name="id_dispo">

                    <!-- Input untuk id_pegawai -->
                    <input type="hidden" id="id_pegawai" name="id_pegawai">

                    <!-- Input untuk id_catatan (ID catatan yang sedang diedit) -->
                    <input type="hidden" id="id" name="id">

                    <!-- Input untuk catatan -->
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan"
                            rows="4">{{ old('catatan', $catatan->catatan) }}</textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<!-- End Modal -->


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Script untuk menangani event klik pada tombol dan mengisi input untuk modal-add
        $('#modal-add').on('show.bs.modal', function (event) {
            // Ambil tombol yang memicu modal
            var button = $(event.relatedTarget);  
            var id_dispo = button.data('id_dispo');  // Ambil ID Disposisi dari data-id_dispo
            var id_pegawai = button.data('id_pegawai');  // Ambil ID Pegawai dari data-id_pegawai
        
            // Isi input hidden #id_dispo dan #id_pegawai dengan data yang diambil
            var modal = $(this);
            modal.find('#id_dispo').val(id_dispo);  // Mengisi input tersembunyi dengan id_dispo
            modal.find('#id_pegawai').val(id_pegawai);  // Mengisi input tersembunyi dengan id_pegawai
        });
    
        // Script untuk menangani event klik pada tombol dan mengisi input untuk modal-edit
        $('#modal-edit').on('show.bs.modal', function (event) {
            // Ambil tombol yang memicu modal
            var button = $(event.relatedTarget);
            var id_dispo = button.data('id_dispo');  // Ambil ID Disposisi dari data-id_dispo
            var id_pegawai = button.data('id_pegawai');  // Ambil ID Pegawai dari data-id_pegawai
            var id = button.data('id');  // Ambil id yang akan diedit
            var catatan = button.data('catatan');  // Ambil catatan yang akan diedit

            // Isi input dalam modal
            var modal = $(this);
            modal.find('#id_dispo').val(id_dispo);  // Mengisi input tersembunyi dengan id_dispo
            modal.find('#id_pegawai').val(id_pegawai);  // Mengisi input tersembunyi dengan id_pegawai
            modal.find('#id').val(id);  // Mengisi textarea dengan id yang ada
            modal.find('#catatan').val(catatan);  // Mengisi textarea dengan catatan yang ada
        });
    });
</script>





@endsection

</html>