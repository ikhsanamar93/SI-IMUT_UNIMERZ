@extends('home.home_layout')
@section('title', 'SI-IMUT | Tendik')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
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

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Data Responden</h5>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) tidak boleh KOSONG!!!<p><br>
                                        <strong>isilah kuesioner sesuai dengan kondisi yang sebenarnya, data dan isian anda
                                            akan kami RAHASIAKAN!!!</strong>
                                    </p>
                                </div>
                                <form action="{{ route('list1_survey_tendik') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Nomor Kepegawaian <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nomor"
                                                class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                                placeholder="Nomor Induk Kepegawaian" value="{{ old('nomor') }}"
                                                maxlength="30" required>
                                            @error('nomor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Nama Tendik <span>*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama"
                                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                                placeholder="Nama Pegawai" value="{{ old('nama') }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Unit Kerja *</label>
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
                                        <label class="col-sm-4 text-md-right">Tendik Fakultas</label>
                                        <div class="col-sm-5">
                                            <select name="fakultas_id"
                                                class="form-control form-control-sm select2 @error('fakultas_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;">
                                                <option></option>
                                                @foreach ($UnitMastersF as $UnitMaster)
                                                    @if (old('fakultas_id') == $UnitMaster->id)
                                                        <option value="{{ $UnitMaster->id }}" selected>
                                                            {{ $UnitMaster->nm_unit }}</option>
                                                    @else
                                                        <option value="{{ $UnitMaster->id }}">
                                                            {{ $UnitMaster->nm_unit }}
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
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Tendik Prodi</label>
                                        <div class="col-sm-5">
                                            <select name="prodi_id"
                                                class="form-control form-control-sm select2 @error('prodi_id') is-invalid @enderror"
                                                data-dropdown-css-class="select2-dark" style="width: 100%;">
                                                <option></option>
                                                @foreach ($UnitMastersP as $UnitMaster)
                                                    @if (old('prodi_id') == $UnitMaster->id)
                                                        <option value="{{ $UnitMaster->id }}" selected>
                                                            {{ $UnitMaster->nm_unit }}</option>
                                                    @else
                                                        <option value="{{ $UnitMaster->id }}">
                                                            {{ $UnitMaster->nm_unit }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('prodi_id')
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
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection
