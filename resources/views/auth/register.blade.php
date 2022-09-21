@extends('home.home_layout')
@section('title', 'SI-IMUT | Registrasi')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('body')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><small>Sistem Informasi Penjaminan Mutu</small></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">IJAGO SPMI</a></li>
                            <li class="breadcrumb-item active">v1-Pro</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="toast toastsDefaultWarning"></div>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Form Registrasi User</h5>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) tidak boleh KOSONG!!!
                                </div>
                                <form action="{{ route('request_register') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Jenis User <span>*</span></label>
                                        <div class="col-sm-5">
                                            <div>
                                                <input value="1" type="radio" name="user_kategori" required>
                                                <label>Dosen </label>
                                                <input value="2" type="radio" name="user_kategori" required>
                                                <label>Tendik</label>
                                            </div>
                                            @error('user_kategori')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Nomor Identitas <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nomor"
                                                class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                                placeholder="Nomor Induk User" value="{{ old('nomor') }}" maxlength="30"
                                                required>
                                            <small><i>Digunakan sebagai username saat login</i></small>
                                            @error('nomor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Nama User <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama"
                                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                                placeholder="Nama User" value="{{ old('nama') }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Gender <span>*</span></label>
                                        <div class="col-sm-5">
                                            <div>
                                                <input value="L" type="radio" name="gender" required>
                                                <label>Laki-Laki </label>
                                                <input value="P" type="radio" name="gender" required>
                                                <label>Perempuan</label>
                                            </div>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Unit Kerja <span>*</span></label>
                                        <div class="col-sm-5">
                                            <select name="unit_master_id"
                                                class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                                <option></option>
                                                @foreach ($UnitMasters as $UnitMaster)
                                                    @if (old('unit_master_id') == $UnitMaster->id)
                                                        <option value="{{ $UnitMaster->id }}" selected>
                                                            {{ $UnitMaster->nm_unit }}</option>
                                                    @else
                                                        <option value="{{ $UnitMaster->id }}">
                                                            {{ $UnitMaster->nm_unit }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <small><i>Wajib Untuk Dosen dan Tendik</i></small>
                                            @error('unit_master_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Homebase Fakultas <span>*</span></label>
                                        <div class="col-sm-5">
                                            <select name="fakultas_id"
                                                class="form-control form-control-sm select2 @error('fakultas_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;">
                                                <option></option>
                                                @foreach ($Fakultast as $Fakultas)
                                                    @if (old('fakultas_id') == $Fakultas->id)
                                                        <option value="{{ $Fakultas->id }}" selected>
                                                            {{ $Fakultas->nm_unit }}</option>
                                                    @else
                                                        <option value="{{ $Fakultas->id }}">
                                                            {{ $Fakultas->nm_unit }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <small><i>Wajib Untuk Dosen</i></small>
                                            @error('fakultas_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Homebase Prodi <span>*</span></label>
                                        <div class="col-sm-5">
                                            <select name="prodi_id"
                                                class="form-control form-control-sm select2 @error('prodi_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;">
                                                <option></option>
                                                @foreach ($Prodis as $Prodi)
                                                    @if (old('prodi_id') == $Prodi->id)
                                                        <option value="{{ $Prodi->id }}" selected>
                                                            {{ $Prodi->nm_unit }}</option>
                                                    @else
                                                        <option value="{{ $Prodi->id }}">
                                                            {{ $Prodi->nm_unit }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <small><i>Wajib Untuk Dosen</i></small>
                                            @error('prodi_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Telp/HP</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="hp"
                                                class="form-control form-control-sm @error('hp') is-invalid @enderror"
                                                placeholder="Telp/HP" value="{{ old('hp') }}" maxlength="12">
                                            @error('hp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">E-Mail *</label>
                                        <div class="col-sm-5">
                                            <input type="email" name="email"
                                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                                placeholder="E-Mail" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control form-control-sm" name="alamat" cols="30" rows="3"></textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Password *</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="password"
                                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                placeholder="Password" required>
                                            <small><i>Password minimum 8 digit</i></small>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Konfirmasi Password *</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="konfirmasi_password"
                                                class="form-control form-control-sm @error('konfirmasi_password') is-invalid @enderror"
                                                placeholder="Konfirmasi Password" required>
                                            @error('konfirmasi_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-sm btn-dark btn-center">
                                    <i class="far fa-circle-check"></i> Submit
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(document).ready(function() {
            $('.toastsDefaultWarning').Toasts('create', {
                class: 'bg-maroon',
                title: 'VAILED PROCESS !!!',
                autohide: true,
                delay: 5000,
                body: 'Registrasi Gagal, Data yang dimasukkan tidak valid'
            })
        });
    </script>
@endsection
