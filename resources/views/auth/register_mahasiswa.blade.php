@extends('home.home_layout')
@section('title', 'SI-IMUT | Registrasi Mahasiswa')
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
                                <h5 class="card-title m-0">Form Registrasi Mahasiswa</h5>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) tidak boleh KOSONG!!!
                                </div>
                                <form action="{{ route('request_register') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Nomor Induk/NIM <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nomor"
                                                class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                                placeholder="Nomor Induk Mahasiswa" value="{{ old('nomor') }}"
                                                maxlength="30" required>
                                            @error('nomor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Nama Mahasiswa <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama"
                                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                                placeholder="Nama Mahasiswa" value="{{ old('nama') }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Nomor Kependudukan <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nik"
                                                class="form-control form-control-sm @error('nik') is-invalid @enderror"
                                                placeholder="Nomor Kependudukan" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Jenis Kelamin <span>*</span></label>
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
                                        <label class="col-sm-4 text-md-right">Fakultas</label>
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
                                            @error('fakultas_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-4 text-md-right">Program Studi <span>*</span></label>
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
                                            @error('unit_master_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Angkatan *</label>
                                        <div class="col-sm-5">
                                            <select name="angkatan_id"
                                                class="form-control form-control-sm select2 @error('angkatan_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                                <option></option>
                                                @foreach ($TahunMasters as $TahunMaster)
                                                    @if (old('angkatan_id') == $TahunMaster->id)
                                                        <option value="{{ $TahunMaster->id }}" selected>
                                                            {{ $TahunMaster->tahun }}</option>
                                                    @else
                                                        <option value="{{ $TahunMaster->id }}">
                                                            {{ $TahunMaster->tahun }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('angkatan_id')
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
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Asal Daerah *</label>
                                        <div class="col-sm-5">
                                            <select name="provinsi_id"
                                                class="form-control form-control-sm select2 @error('provinsi_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                                <option></option>
                                                @foreach ($ProvinsiMasters as $ProvinsiMaster)
                                                    @if (old('provinsi_id') == $ProvinsiMaster->id)
                                                        <option value="{{ $ProvinsiMaster->id }}" selected>
                                                            {{ $ProvinsiMaster->nm_provinsi }}</option>
                                                    @else
                                                        <option value="{{ $ProvinsiMaster->id }}">
                                                            {{ $ProvinsiMaster->nm_provinsi }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('provinsi_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Kabupaten *</label>
                                        <div class="col-sm-5">
                                            <select name="daerah_id"
                                                class="form-control form-control-sm select2 @error('daerah_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                                <option></option>

                                            </select>
                                            @error('daerah_id')
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
