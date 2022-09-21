@extends('layouts.main')
@section('title', 'SI-IMUT | Edit Unit Kerja')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Unit Kerja</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('index_unit_kerja') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>
            <form class="form-horizontal" action="{{ route('update_unit_kerja', $UnitMasters->id) }}" method="POST"
                enctype="multipart/form-data" autocomplete="off">
                @csrf @method('PUT')
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) tidak boleh KOSONG!!!
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Jenis Unit Kerja <span>*</span></label>
                        <div class="col-sm-5">
                            <select name="unit_kategori_id"
                                class="form-control form-control-sm select2 @error('unit_kategori_id') is-invalid @enderror"
                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                <option value=""></option>
                                @foreach ($UnitKategoris as $UnitKategori)
                                    @if ($UnitMasters->unit_kategori_id == $UnitKategori->id)
                                        <option value="{{ $UnitKategori->id }}" selected>
                                            {{ $UnitKategori->nm_unit_kategori }}</option>
                                    @else
                                        <option value="{{ $UnitKategori->id }}">{{ $UnitKategori->nm_unit_kategori }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('unit_kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Unit Pengelola <span>*</span></label>
                        <div class="col-sm-5">
                            <select name="unit_pengelola_id"
                                class="form-control form-control-sm select2 @error('unit_pengelola_id') is-invalid @enderror"
                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                <option value=""></option>
                                @foreach ($UnitPengelolas as $UnitPengelola)
                                    @if ($UnitMasters->unit_pengelola_id == $UnitPengelola->id)
                                        <option value="{{ $UnitPengelola->id }}" selected>
                                            {{ $UnitPengelola->nm_unit_pengelola }}</option>
                                    @else
                                        <option value="{{ $UnitPengelola->id }}">
                                            {{ $UnitPengelola->nm_unit_pengelola }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('unit_pengelola_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Nama Unit Kerja <span>*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="nm_unit"
                                class="form-control form-control-sm @error('nm_unit') is-invalid @enderror"
                                placeholder="Nama Unit Kerja" value="{{ $UnitMasters->nm_unit }}" required="">
                            @error('nm_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Kode Unit Kerja</label>
                        <div class="col-sm-5">
                            <input type="text" name="no_unit"
                                class="form-control form-control-sm @error('no_unit') is-invalid @enderror"
                                placeholder="Kode Unit Kerja" value="{{ $UnitMasters->no_unit }}" maxlength="30">
                            @error('no_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">No. SK Pengesahan</label>
                        <div class="col-sm-5">
                            <input type="text" name="no_penetapan_unit"
                                class="form-control form-control-sm @error('no_penetapan_unit') is-invalid @enderror"
                                value="{{ $UnitMasters->no_penetapan_unit }}" placeholder="Nomor Pengesahan Unit Kerja"
                                maxlength="30">
                            @error('no_penetapan_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Tgl. SK Pengesahan</label>
                        <div class="input-group date col-sm-5" id="tgl_penetapan" data-target-input="nearest">
                            <input type="text" name="tgl_penetapan_unit"
                                class="form-control form-control-sm datetimepicker-input @error('tgl_penetapan_unit') is-invalid @enderror"
                                value="{{ $UnitMasters->tgl_penetapan_unit }}" data-target="#tgl_penetapan" />
                            <div class="input-group-append" data-target="#tgl_penetapan" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('tgl_penetapan_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Deskripsi</label>
                        <div class="col-sm-5">
                            <textarea name="ket" class="form-control form-control-sm @error('ket') is-invalid @enderror" rows="4"
                                placeholder="Deskripsi Unit Kerja ...">{{ $UnitMasters->ket }}</textarea>
                            @error('ket')
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
                    <button type="reset" class="btn btn-sm btn-danger">
                        <i class="fa fa-cancel"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script type="text/javascript">
        $('select').select2();

        $(function() {
            $('#tgl_penetapan').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        })
    </script>
@endsection
