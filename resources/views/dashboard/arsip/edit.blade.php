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
                                <div class="card-title">Detail Data Arsip</div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{route("arsip.update",$arsip->id_arsip)}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <!-- Kiri -->
                                        <div class="col-lg-12">
                                            <!-- Tgl Arsip -->
                                            <div class="mb-3">
                                                <label class="form-label" for="tgl_arsip">Tanggal Arsip :</label>
                                                <input type="date" id="tgl_arsip" name="tgl_arsip"
                                                    class="form-control @error('tgl_arsip') is-invalid @enderror"
                                                    required autofocus
                                                    value="{{ old('tgl_arsip', $arsip->tgl_arsip) }}" />
                                            </div>
                                            <!-- ID Dispo -->
                                            <div class="mb-3">
                                                <label class="form-label" for="id_dispo">No Surat</label>
                                                <input type="text" id="id_dispo" name="id_dispo"
                                                    class="form-control @error('id_dispo') is-invalid @enderror"
                                                    value="{{ old('id_dispo', $arsip->id_dispo) }}" disabled />
                                                @error('id_dispo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- ID sm -->
                                            <div class="mb-3">
                                                <label class="form-label" for="id_sm">No Agenda</label>
                                                <input type="text" id="id_sm" name="id_sm"
                                                    class="form-control @error('id_sm') is-invalid @enderror"
                                                    value="{{ old('id_sm', $arsip->id_sm) }}" disabled />
                                                @error('id_sm')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- ID pegawai -->
                                            <div class="mb-3">
                                                <label class="form-label" for="id_pegawai">Nama Pegawai</label>
                                                <input type="text" id="id_pegawai" name="id_pegawai"
                                                    class="form-control @error('id_pegawai') is-invalid @enderror"
                                                    value="{{ old('id_pegawai', $arsip->id_pegawai) }}" disabled />
                                                @error('id_pegawai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>



                                        </div>
                                        <!-- End column -->
                                    </div>
                                    <!-- Submit button -->
                                    <div class="text-end">
                                        <a href="{{ route('arsip.index') }}" class="btn btn-rounded btn-warning col-lg-4">Cancel</a>
                                                
                                        <button type="submit"
                                            class="btn btn-rounded btn-primary col-lg-4">Save</button>
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